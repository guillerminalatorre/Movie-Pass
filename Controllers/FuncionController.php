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
	
		public function ShowAddView($nombre_Cine)
		{
			$id = $this->funcionDAO->iDdisponible();

			require_once(VIEWS_PATH."funcion-add.php");		
		}

		public function eliminarFuncion($id)
		{
			$funcion = $this->funcionDAO->getById($id);

			$nombreCine = $funcion->getNombre_Cine();

			$this->funcionDAO->remove($id);

			header("Location: ".FRONT_ROOT."Cine/ShowFichaCine/".$nombreCine);
		}

		public function Add($id, $nombre_Cine, $id_Pelicula, $fecha,  $hora,  $cantEntradas)
		{
			$funcion = new Funcion();

			$funcion->setId($id);
			$funcion->setNombre_Cine($nombre_Cine);
			$funcion->setFecha($fecha);
			$funcion->setHora($hora);
			$funcion->setId_Pelicula($id_Pelicula);
			$funcion->setCantEntradas($cantEntradas);
			$funcion->setCantVendidas(0);

			$this->funcionDAO->add($funcion);

			header("Location: ".FRONT_ROOT."Cine/ShowFichaCine/".$nombre_Cine);
		}
	}
?>