<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\FuncionDAO as FuncionDAO;
	use Models\Funcion as Funcion;

	class FuncionController
	{
		private $funcionDAO;

		function __construct()
		{
			$this->funcionDAO = new FuncionDAO();
		}

		public function ShowAddView($nombreCine)
		{
			$id = $this->IdDisponible();
			require_once(VIEWS_PATH."cine/funcion-add.php");
		}

		public function eliminarFuncion($id)
		{
			$_SESSION['flash'] = array();
			$funcion = $this->funcionDAO->getById($id);

			$nombreCine = $funcion->getNombreCine();

			$this->funcionDAO->remove($id);

			array_push($_SESSION['flash'], "La funcion se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Cine","ShowFichaView", $nombreCine);
		}

		public function Add($id, $nombreCine, $idPelicula, $fecha,  $hora,  $cantEntradas)
		{
			$_SESSION['flash'] = array();
			$funcion = new Funcion();

			$funcion->setId($id);
			$funcion->setNombreCine($nombreCine);
			$funcion->setFecha($fecha);
			$funcion->setHora($hora);
			$funcion->setIdPelicula($idPelicula);
			$funcion->setCantEntradas($cantEntradas);
			$funcion->setCantVendidas(0);

			$this->funcionDAO->add($funcion);

			array_push($_SESSION['flash'], "La funcion se ha agregado correctamente.");
			Functions::getInstance()->redirect("Cine","ShowFichaView", $nombreCine);
		}
		
		public function iDdisponible()
		{
			$rta = 0;
			$funcionList = $this->funcionDAO->getAll();
			foreach($funcionList as $funcion)
			{
				$rta = $funcion->getId();
			}
			return $rta+1;
		}
	}
?>