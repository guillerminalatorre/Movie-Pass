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

		public function getFuncionList()
		{
			$funcionList = $this->funcionDAO->getAll();
			return $funcionList;
		}

		public function getFuncionesDeCine($nombre)
		{
			$funcionList = $this->funcionDAO->getByCine($nombre);
			return $funcionList;
		}

		public function eliminarPorCine($nombre)
		{
			$this->funcionDAO->eliminarGetByCine($nombre);
		}

		public function eliminarFuncion($id)
		{
			$_SESSION['flash'] = array();
			$funcion = $this->funcionDAO->getById($id);

			$nombre_Cine = $funcion->getNombre_Cine();

			$this->funcionDAO->remove($id);

			array_push($_SESSION['flash'], "La funcion se ha eliminado correctamente.");
			Functions::getInstance()->redirect("Home","FichaCine", $nombre_Cine);
		}

		public function Add($id, $nombre_Cine, $id_Pelicula, $fecha,  $hora,  $cantEntradas)
		{
			$_SESSION['flash'] = array();
			$funcion = new Funcion();

			$funcion->setId($id);
			$funcion->setNombre_Cine($nombre_Cine);
			$funcion->setFecha($fecha);
			$funcion->setHora($hora);
			$funcion->setId_Pelicula($id_Pelicula);
			$funcion->setCantEntradas($cantEntradas);
			$funcion->setCantVendidas(0);

			$this->funcionDAO->add($funcion);

			array_push($_SESSION['flash'], "La funcion se ha agregado correctamente.");
			Functions::getInstance()->redirect("Home","FichaCine", $nombre_Cine);
		}

		public function iDdisponible()
		{
			$rta = 0;
			$funcionList = $this->getFuncionList();
			foreach($funcionList as $funcion)
			{
				$rta = $funcion->getId();
			}
			return $rta+1;
		}
	}
?>