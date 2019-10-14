<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\FuncionDAO as FuncionDAO;
	use Models\Funcion as Funcion;
	use DAO\CineDAO as CineDAO;
	use Models\Cine as Cine;	

	class FuncionController
	{
		private $funcionDAO;
		private $cineDAO;

		function __construct()
		{
			$this->funcionDAO = new FuncionDAO();
			$this->cineDAO = new CineDAO();
		}
	
		public function ShowAddView($nombre_Cine)
		{
			$nombre_Cine = $nombre_Cine;

			$id = $this->funcionDAO->iDdisponible();

			require_once(VIEWS_PATH."funcion-add.php");		
		}
	
		public function ShowListView()
		{
			$funcionList = $this->funcionDAO->getAll();
	
			require_once(VIEWS-PATH."");
		}

		/*public function Add(int $id, int $id_Cine, string $fecha, string $hora, int $id_Pelicula, int $cantEntradas, int $cantVendidas)
		{
			$funcion = new Funcion($id, $id_Cine, $fecha, $hora, $id_Pelicula, $cantEntradas, $cantVendidas);

			$this->funcionDAO->eliminarFuncion($id);

			$cine = $this->cineDAO->cineXnombre($nombreCine);

			$funciones = $this->funcionDAO->funcionesXcine($nombreCine);

			require_once(VIEWS_PATH."cine-ficha.php");

		}*/


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

			$this->funcionDAO->add($funcion);

			$this->ShowFichaCine($nombreCine);

		}

		public function ShowFichaCine($nombreCine)
		{
			$cine = $this->cineDAO->cineXnombre($nombreCine);

			$funciones = $this->funcionDAO->funcionesXcine($nombreCine);

			require_once(VIEWS_PATH."cine-ficha.php");
		}
	}
?>