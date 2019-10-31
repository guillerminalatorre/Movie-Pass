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
use Models\Compra as Compra;
use Models\Cine as Cine;
use Models\Funcion as Funcion;
use Models\Usuario as Usuario;
use Models\Entrada as Entrada;
use Config\Functions as Functions;

class CompraController
{
	private $compraDAO;
	private $cineDAO;
	private $funcionDAO;

	function __construct()
	{
		$this->compraDAO = new CompraDAO();
		$this->cineDAO = new CineDAO();
		$this->funcionDAO = new FuncionDAO();
	}

	public function Pay($idFuncion = null, $cantidad)
	{
		$_SESSION['flash'] = array();
		if($idFuncion != null)
		{
			//Datos funcion
			$funcion = new Funcion();
			$funcion->setId($idFuncion);
			$funcion = $this->funcionDAO->getFuncion($funcion);
			if($funcion != null)
			{
				$idCine = $funcion->getIdCine();
				$fechaHora = $funcion->getFechaHora();

				//Datos cine			
				$cine = $this->cineDAO->getById($idCine);
				$precio = $cine->getPrecio();

				//Calculos
				$descuento = $this->calcularDescuento($fechaHora, $cantidad);
				$total = ($precio*$cantidad)*($descuento/100);

				require_once(VIEWS_PATH."compra/compra.php");
			}
			else
			{
				array_push($_SESSION['flash'], "La funcion seleccionada no existe.");
				Functions::getInstance()->redirect("Home");
			}				
		}			
		else
		{				
			array_push($_SESSION['flash'], "Debes seleccionar una funcion para efectuar la compra.");
			Functions::getInstance()->redirect("Home");
		}
	}

	public function Payout($idFuncion, $cantidad)
	{
		//Datos funcion
		$funcion = new Funcion();
		$funcion->setId($idFuncion);
		$funcion = $this->funcionDAO->getFuncion($funcion);
		if($funcion != null)
		{
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
			$compra->setFechaHora(time());
			$compra->setPrecio($precio);
			$compra->setCantidad($cantidad);
			$compra->setDescuento($descuento);
			$compra->setTotal($total);
			$this->compraDAO->add($compra);

			//Generar entradas
			$compra = $this->compraDAO->getByUsuario($_SESSION['loggedUser']);
			$idCompra = $compra->getId();
			for ($i = $cantidad; $i > 0; $i--) {
				$entrada = new Entrada();
				$entrada->setIdCompra($idCompra);
				$entrada->setIdFuncion($idFuncion);
				$entrada->setQr($idCine."-".$idFuncion."-".$idEntrada);
				$this->entradaDAO->add($entrada);
				// API GOOGLE: https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Hello%20world
			}
			array_push($_SESSION['flash'], "La compra se ha realizado con exito.");
			Functions::getInstance()->redirect("Entrada","MisEntradas");
		}
		else
		{
			array_push($_SESSION['flash'], "La funcion seleccionada no existe.");
			Functions::getInstance()->redirect("Home");
		}			
	}
	
	private function calcularDescuento($fechaHora, $cantidad)
	{
		$descuento = 0;
		$day = date('w', strtotime($fechaHora));
		if(($day == 2 || $day == 3) && $cantidad >= 2) $descuento = 25;
		return $descuento;
	}
}
?>