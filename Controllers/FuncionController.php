<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\FuncionDAO as FuncionDAO;
	use Models\Funcion as Funcion;
	use Controllers\CineController as CineController;

	class FuncionController
	{
		private $funcionDAO;
		private $cineController;

		function __construct()
		{
			$this->funcionDAO = new FuncionDAO();
			$this->cineController =new CineController();
		}
	
		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "");
		}
	
		public function ShowListView()
		{
			$funcionList = $this->funcionDAO->getAll();
	
			require_once(VIEWS_PATH."");
		}

		public function eliminarFuncionYredirect($id)
		{
			$nombreCine = $this->funcionDAO->cineXid($id);

			$this->funcionDAO->eliminarFuncion($id);

			header("Location: ../Cine/ShowFichaCine");

		}

		public function ShowAgregarFuncion($nombre_Cine)
		{
			$nombre_Cine = $nombre_Cine;
			require_once(VIEWS_PATH."funcion-add.php");
		}

		public function Add(  $id, $nombreCine, $id_Pelicula, $fecha,  $hora,  $cantEntradas)
		{
			$funcion = new Funcion();

			$funcion->setId($id);
			$funcion->setNombre_Cine($nombreCine);
			$funcion->setFecha($fecha);
			$funcion->setHora($hora);
			$funcion->setId_Pelicula($id_Pelicula);
			$funcion->setCantEntradas($cantEntradas);
			$funcion->setCantVendidas(0);

			require_once(ROOT. "Cine/ShowFichaCine/$nombreCine");

		}
	}
?>