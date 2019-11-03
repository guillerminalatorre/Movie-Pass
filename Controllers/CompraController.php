<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */
namespace Controllers;

use DAO\CompraDAO as CompraDAO;
use DAO\CineDAO as CineDAO;
use DAO\FuncionDAO as FuncionDAO;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\EntradaDAO as EntradaDAO;
use Models\Compra as Compra;
use Models\Cine as Cine;
use Models\Funcion as Funcion;
use Models\Usuario as Usuario;
use Models\Entrada as Entrada;
use Models\Pelicula as Pelicula;

class CompraController extends Administrable
{
	private $compraDAO;
	private $cineDAO;
	private $funcionDAO;
	private $peliculaDAO;
	private $entradaDAO;

	function __construct()
	{
		$this->compraDAO = new CompraDAO();
		$this->cineDAO = new CineDAO();
		$this->funcionDAO = new FuncionDAO();
		$this->peliculaDAO = new PeliculaDAO();
		$this->entradaDAO = new EntradaDAO();
	}

	public function Pay($idFuncion,$cantidad)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");

		if(!isset($_SESSION['flash'])) $_SESSION['flash'] = array();

		//Datos funcion
		$funcion = new Funcion();
		$funcion->setId($idFuncion);
		$funcion = $this->funcionDAO->getFuncion($funcion);
		if($funcion == null)
		{
			array_push($_SESSION['flash'], "La funcion seleccionada no existe.");
			Functions::redirect("Home");
		}

		$pelicula = new Pelicula();
		$pelicula->setId($funcion->getIdPelicula());
		$pelicula = $this->peliculaDAO->getPelicula($pelicula);

		$idCine = $funcion->getIdCine();
		$fechaHora = $funcion->getFechaHora();

		//Datos cine			
		$cine = $this->cineDAO->getById($idCine);
		$precio = $cine->getPrecio();

		//Calculos
		$subtotal = ($precio*$cantidad);
		$descuento = $this->calcularDescuento($fechaHora, $cantidad);
		$total = $subtotal*($descuento/100);

		require_once(VIEWS_PATH."compra/compra.php");
	}

	public function Payout($idFuncion,$cantidad,$name,$mmyy,$number,$cvc)
	{
		if(!$this->loggedIn()) Functions::redirect("Home");

		$_SESSION['flash'] = array();
		
		$name = Functions::validateData($name);
		$mmyy = Functions::validateData($mmyy);
		$number = Functions::validateData($number);
		$cvc = Functions::validateData($cvc);
		if(!$this->validatePay($name,$mmyy,$number,$cvc))
		{			
			$params = array();
			array_push($params,$idFuncion);
			array_push($params,$cantidad);
			array_push($_SESSION['flash'], "Los datos de la tarjeta son incorrectos.");
			Functions::redirect("Compra","Pay",$params);
		}

		//Datos funcion
		$funcion = new Funcion();
		$funcion->setId($idFuncion);
		$funcion = $this->funcionDAO->getFuncion($funcion);
		if($funcion == null)
		{
			array_push($_SESSION['flash'], "La funcion seleccionada no existe.");
			Functions::redirect("Home");
		}

		$pelicula = new Pelicula();
		$pelicula->setId($funcion->getIdPelicula());
		$pelicula = $this->peliculaDAO->getPelicula($pelicula);

		$idCine = $funcion->getIdCine();
		$fechaHora = $funcion->getFechaHora();

		//Datos cine			
		$cine = $this->cineDAO->getById($idCine);
		$precio = $cine->getPrecio();

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
		$this->compraDAO->add($compra);

		//Generar entradas
		$listCompras = $this->compraDAO->getByUsuario($_SESSION['loggedUser']);
		$compra = array_pop($listCompras);
		$idCompra = $compra->getId();
		for ($i = $cantidad; $i > 0; $i--) {
			$entrada = new Entrada();
			$entrada->setIdCompra($idCompra);
			$entrada->setIdFuncion($idFuncion);
			$entrada->setQr($idCine."-".$idFuncion."-".$idCompra);
			$this->entradaDAO->add($entrada);
		}
		array_push($_SESSION['flash'], "Se han generado ".$cantidad." entrada(s) para ver ".$pelicula->getTitulo()."!");
		Functions::redirect("Entrada","ShowListView", $_SESSION['loggedUser']->getId());
	}

	private function validatePay($name,$mmyy,$number,$cvc)
	{
		$validateCard = CreditCard::validCreditCard($number);
		if($validateCard['valid'] == false) return false;

		$validateCvc = CreditCard::validCvc($cvc, $validateCard['type']);
		if($validateCvc == false) return false;

		$date = explode(" / ", $mmyy);
		$validateDate = CreditCard::validDate("20".$date[1], $date[0]);
		if(!$validateDate) return false;

		array_push($_SESSION['flash'], "Tu compra con tarjeta ".$validateCard['type']." fue procesada con éxito.");
		return true;
	}
	
	private function calcularDescuento($fechaHora, $cantidad)
	{
		$descuento = 100;
		$day = date('w', strtotime($fechaHora));
		if(($day == 2 || $day == 3) && $cantidad >= 2) $descuento = 25;
		return $descuento;
	}
}
?>