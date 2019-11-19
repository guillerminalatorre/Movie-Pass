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
			$descuentoPorcent = $this->calcularDescuento($fechaHora, $cantidad);
			$descuento= $subtotal*($descuentoPorcent/100);
			$total = $subtotal-$descuento;

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
			$total = ($precio*$cantidad)-(($precio*$cantidad)*($descuento/100));

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

			$emailDetails=array();
			$emailDetails['pelicula'] = $pelicula->getTitulo();
			$emailDetails['fechaHora'] = $fechaHora;
			$emailDetails['cine'] = $cine->getNombre();
			$emailDetails['sala'] = $sala->getNombre();
			$emailDetails['idCompra'] = $idCompra;
		
			Functions::sendEmail($_SESSION['loggedUser']->getEmail(),$subject, $this->compraMailBody($emailDetails));
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
			$descuento = 0;
			$day = date('w', strtotime($fechaHora));
			if(($day == 2 || $day == 3) && $cantidad >= 2) $descuento = 25;
			return $descuento;
		}

		private function compraMailBody($emailDetails){

			$pelicula = $emailDetails['pelicula'];
			$fechaHora = $emailDetails['fechaHora'];
			$cine = $emailDetails['cine'];
			$sala = $emailDetails['sala'];
			$compra = new Compra();
			$entradas = $this->entradaDAO->getByCompra($compra->setId($emailDetails['idCompra']));
			
			$message  = "<html>
			<body style='background-color:#fff; background-image:url(https://i.imgur.com/t216lYB.jpg); background-size:cover' bgcolor='#fff' >
			&nbsp;
			<table align='center' border='0' cellpadding='0' cellspacing='0' style='font-family: Raleway, Helvetica,sans-serif;border-radius: 30px; background-image: url(https://i.imgur.com/hINcb6A.png); background-size: cover' width='650'>
				<tbody>
					<tr>
						<td style='font-family: Raleway, Helvetica,sans-serif;font-weight:400;font-size:15px;color:#fff;text-align:center;padding:20px;line-height:25px; ' class=''><center><img src='https://i.imgur.com/uSaf2DO.png' style='display: block'></center>
			&nbsp;
			<center><img src='https://i.imgur.com/kvDOOvM.gif' style='display: block; border-radius: 200px' width='200'></center>
			<p style='color: whitesmoke; font-size: 36px; font-weight: 900; line-height: 40px; text-align:center'>Te acercamos tus entradas<br></p></td></tr>
			</tbody>
			</table>
			&nbsp;
			&nbsp;";

						foreach ($entradas as $entrada) { 

							$qr = $entrada->getQr();
						
							$message.="<table align='center' border='0' cellpadding='0' cellspacing='0' style='font-family: Montserrat, Helvetica, sans-serif;' width='650'>
							<tbody>
								<tr>
									<td bgcolor='#fff' style='color:#666; text-align:left; font-size:14px;font-family:Montserrat, Helvetica, sans-serif; padding:20px 0px 20px 40px; line-height:25px; border-radius:30px 0 0 30px;' valign='middle' width='50%' class=''>
									<h2 style= letter-spacing: 1px; font-weight: 700; font-size: 26px; text-align: center; margin: 0; line-height: normal'>".$pelicula."<br></h2>
															
									<table align='center' border='0' cellpadding='0' cellspacing='0' width='280'>
										<tbody>
											<h4 style= letter-spacing: 1px; font-weight: 700; font-size: 26px; text-align: center; margin: 0; line-height: normal'>".$cine." </h4>
											<h4 style= letter-spacing: 1px; font-weight: 700; font-size: 26px; text-align: center; margin: 0; line-height: normal'>Sala ".$sala."<br></h4>
											<h4 style= letter-spacing: 1px; font-weight: 700; font-size: 26px; text-align: center; margin: 0; line-height: normal'>Fecha: ".$fechaHora."<br></h4>
										</tbody>
									</table>
									</td>
									<td bgcolor='#fff' style='color:#666; text-align:center; font-size:13px; padding:20px 0px 20px 40px; line-height:25px; border-radius:0 30px 30px 0;' valign='middle' width='50%' class=''>
									<center><img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=.$qr style='display:block'></center>
									</td>
								</tr>
							</tbody>
						</table>
						&nbsp;";
						}
						$message.="<h3 style='color: whitesmoke; text-align:center'>¡Que disfrutes de la función!<br></h3></body></html>";
			return $message;
		}
	}
?>