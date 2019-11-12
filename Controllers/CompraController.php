<?php
	namespace Controllers;

	use DAO\CompraDAO as CompraDAO;
	use DAO\CineDAO as CineDAO;
	use DAO\SalaDAO as SalaDAO;
	use DAO\FuncionDAO as FuncionDAO;
	use DAO\PeliculaDAO as PeliculaDAO;
	use DAO\EntradaDAO as EntradaDAO;
	use Models\Compra as Compra;
	use Models\Cine as Cine;
	use Models\Sala as Sala;
	use Models\Funcion as Funcion;
	use Models\Usuario as Usuario;
	use Models\Entrada as Entrada;
	use Models\Pelicula as Pelicula;

	class CompraController extends Administrable
	{
		private $compraDAO;
		private $cineDAO;
		private $salaDAO;
		private $funcionDAO;
		private $peliculaDAO;
		private $entradaDAO;

		function __construct()
		{
			$this->compraDAO = new CompraDAO();
			$this->cineDAO = new CineDAO();
			$this->salaDAO = new SalaDAO();
			$this->funcionDAO = new FuncionDAO();
			$this->peliculaDAO = new PeliculaDAO();
			$this->entradaDAO = new EntradaDAO();
		}

		public function Pay($idFuncion,$cantidad)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");

			//Datos funcion
			$funcion = new Funcion();
			$funcion->setId($idFuncion);
			$funcion = $this->funcionDAO->getFuncion($funcion);
			if($funcion == null)
			{
				Functions::flash("La funcion seleccionada no existe.","warning");
				Functions::redirect("Home");
			}

			//Datos pelicula
			$pelicula = new Pelicula();
			$pelicula->setId($funcion->getIdPelicula());
			$pelicula = $this->peliculaDAO->getPelicula($pelicula);
			if($pelicula == null)
			{
				Functions::flash("La pelicula seleccionada no existe.","warning");
				Functions::redirect("Home");
			}

			$fechaHora = $funcion->getFechaHora();

			//Datos cine			
			$idCine = $funcion->getIdCine();
			$cine = new Cine();
			$cine->setId($idCine);
			$cine = $this->cineDAO->getCine($cine);
			if($cine == null)
			{
				Functions::flash("El cine seleccionado no existe.","warning");
				Functions::redirect("Home");
			}

			//Datos sala
			$idSala = $funcion->getIdSala();
			$sala = new Sala();
			$sala->setId($idSala);
			$sala = $this->salaDAO->getSala($sala);
			if($sala == null)
			{
				Functions::flash("La sala seleccionada no existe.","warning");
				Functions::redirect("Home");
			}
			$precio = $sala->getPrecio();

			//Calculos
			$subtotal = ($precio*$cantidad);
			$descuento = $this->calcularDescuento($fechaHora, $cantidad);
			$total = $subtotal*($descuento/100);

			require_once(VIEWS_PATH."compra/compra.php");
		}

		public function Payout($idFuncion,$cantidad,$name,$mmyy,$number,$cvc)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			
			$name = Functions::validateData($name);
			$mmyy = Functions::validateData($mmyy);
			$number = Functions::validateData($number);
			$cvc = Functions::validateData($cvc);
			if(!$this->validatePay($name,$mmyy,$number,$cvc))
			{			
				$params = array();
				array_push($params,$idFuncion);
				array_push($params,$cantidad);
				Functions::flash("Los datos de la tarjeta son incorrectos.","warning");
				Functions::redirect("Compra","Pay",$params);
			}

			//Datos funcion
			$funcion = new Funcion();
			$funcion->setId($idFuncion);
			$funcion = $this->funcionDAO->getFuncion($funcion);
			if($funcion == null)
			{
				Functions::flash("La funcion seleccionada no existe.","warning");
				Functions::redirect("Home");
			}

			//Datos pelicula
			$idPelicula = $funcion->getIdPelicula();
			$pelicula = new Pelicula();
			$pelicula->setId($idPelicula);
			$pelicula = $this->peliculaDAO->getPelicula($pelicula);
			if($pelicula == null)
			{
				Functions::flash("La pelicula seleccionada no existe.","warning");
				Functions::redirect("Home");
			}

			$fechaHora = $funcion->getFechaHora();

			//Datos cine			
			$idCine = $funcion->getIdCine();
			$cine = new Cine();
			$cine->setId($idCine);
			$cine = $this->cineDAO->getCine($cine);
			if($cine == null)
			{
				Functions::flash("El cine seleccionado no existe.","warning");
				Functions::redirect("Home");
			}

			//Datos sala
			$idSala = $funcion->getIdSala();
			$sala = new Sala();
			$sala->setId($idSala);
			$sala = $this->salaDAO->getSala($sala);
			if($sala == null)
			{
				Functions::flash("La sala seleccionada no existe.","warning");
				Functions::redirect("Home");
			}
			$precio = $sala->getPrecio();

			//Calculos
			$descuento = $this->calcularDescuento($fechaHora, $cantidad);
			$total = ($precio*$cantidad)*($descuento/100);

			//Guardar compra
			$compra = new Compra();
			$compra->setIdUsuario($_SESSION['loggedUser']->getId());
			$compra->setFechaHora(date("Y-m-d H:i:s"));
			$compra->setPrecio($precio);
			$compra->setCantidad($cantidad);
			$compra->setDescuento($descuento);
			$compra->setTotal($total);
			if(!$this->compraDAO->add($compra)) 
			{
				Functions::flash("Se produjo un error al registrar la compra. Tu pago será devuelto.","danger");
				Functions::redirect("Funcion","ShowFuncionesPelicula", $idPelicula);
			}			

			//Generar entradas
			$listCompras = $this->compraDAO->getByUsuario($_SESSION['loggedUser']);
			$compra = array_pop($listCompras);
			$idCompra = $compra->getId();

			$listEntradas = array();

			for ($i = 1; $i <= $cantidad; $i++)
			{
				$entrada = new Entrada();
				$entrada->setIdCompra($idCompra);
				$entrada->setIdFuncion($idFuncion);
				$entrada->setQr($idCine."-".$idSala."-".$idFuncion."-".$idCompra."-".$i);
				array_push($listEntradas, $entrada);
				if(!$this->entradaDAO->add($entrada)) Functions::flash("Se produjo un error al registrar la entrada ".$i.".","danger");	
			}
			Functions::flash("Se completo la compra de ".$cantidad." entrada(s) para ver ".$pelicula->getTitulo()."!", "success");
			
			$subject = "Movie Pass - Tus entradas para ver ".$pelicula->getTitulo();
		
			Functions::sendEmail($_SESSION['loggedUser']->getEmail(),$subject, $this->compraMailBody($listEntradas));
			Functions::redirect("Entrada","ShowListView", $_SESSION['loggedUser']->getId());
		}

		private function validatePay($name,$mmyy,$number,$cvc)
		{
			//Validamos numeros de la tarjeta
			$validateCard = CreditCard::validCreditCard($number);
			if($validateCard['valid'] == false) return false;

			//Validamos codigo de seguridad
			$validateCvc = CreditCard::validCvc($cvc, $validateCard['type']);
			if($validateCvc == false) return false;

			//Validamos fecha de expiracion
			$date = explode(" / ", $mmyy);
			$validateDate = CreditCard::validDate("20".$date[1], $date[0]);
			if(!$validateDate) return false;

			//Si pasa todas las validaciones procesamos la compra
			Functions::flash("Tu compra con tarjeta ".$validateCard['type']." fue procesada con éxito.","success");
			return true;
		}
		
		private function calcularDescuento($fechaHora, $cantidad)
		{
			$descuento = 100;
			$day = date('w', strtotime($fechaHora));
			if(($day == 2 || $day == 3) && $cantidad >= 2) $descuento = 25;
			return $descuento;
		}

		private function compraMailBody($entradaList){
			$message  = "<html><head>
			<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
			<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
			</head><body>";
			$message.= "<div class='container-fluid mb-4'>
			<div class='col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-dark-transparent rounded shadow p-2'>
				<h2 class='col-sm-12 col-md-6 pb-2 text-light'>Lista de entradas</h2>
				<table class='table table-striped table-responsive-md text-light align-center border='1' frame='border' rules='groups'>
					<thead bgcolor='#DDE0FC'>
						<tr>
							<th>Nro Entrada</th>
							<th>Pelicula</th>
							<th>N.Funcion</th>
							<th>N.Compra</th>
							<th>QR</th>
						</tr>
					</thead>
					<tbody>";
						foreach ($entradaList as $entrada) { 
							$funcion= new Funcion();
							$pelicula= new Pelicula();
							$idFuncion = $entrada->getIdFuncion();
							$funcion->setId($idFuncion);
							$funcion = $this->funcionDAO->getFuncion($funcion);
							$idPelicula = $funcion->getIdPelicula();
							$pelicula->setId($idPelicula);
							$pelicula = $this->peliculaDAO->getPelicula($pelicula);
							$title= $pelicula->getTitulo();
							$idEntrada= $entrada->getId();
							$idCompra= $entrada->getIdCompra();
							$qr= $entrada->getQr();
							$message.="<tr>
							<td align='center' class='align-middle'>".$idEntrada."</td>
							<td class='align-middle'><b>".$title."</b></a></td>
							<td class='align-middle' align='center'>".$idFuncion."</td>
							<td class='align-middle'align='center'>".$idCompra."</td>
							<td class='align-middle'align='center'><img src='https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=";
							$message.=$qr."'></td></tr>";
						}
						$message.="</tbody></table></div></div></body></html>";
			
			return $message;
		}
	}
?>