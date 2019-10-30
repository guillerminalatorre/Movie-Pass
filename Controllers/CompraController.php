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

		public function Index()
		{
			require_once(VIEWS_PATH."compra/compra.php");
		}

		public function Payout($idFuncion, $cantidad)
		{
			$funcion = new Funcion();
			$funcion->setId($idFuncion);
			$funcion = $this->funcionDAO->getFuncion($funcion);

			$idCine = $funcion->getIdCine();

			$cine = $this->cineDAO->getById($idCine);

			$precio = $cine->getPrecio();

			$fecha = $funcion->getFechaHora();

			$descuento = calcularDescuento($fecha, $cantidad);

			$total = ($precio*$cantidad)*($descuento/100);

			$compra = new Compra($idFuncion, $fecha, $cantidad, $descuento, $total, $_SESSION['loggedUser']);

			$this->compraDAO->add($compra);

			Functions::getInstance()->redirect("Home");
		}
		
		private function calcularDescuento($fecha, $cantidad)
		{
			$descuento = 0;
			if((date('w', $fecha) == 2 || date('w', $fecha) == 3) && $cantidad >= 2) $descuento += 25;
			return $descuento;
		}
	}
?>