<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\CineDAO as CineDAO;
	use Models\Cine as Cine;	
	use DAO\FuncionDao as FuncionDAO;
	use Models\Funcion as Funcion;
	
	class CineController
	{
		private $cineDAO;
		private $funcionDAO;

		public function __construct()
		{
			$this->cineDAO = new CineDAO();
			$this->funcionDAO = new FuncionDAO();
		}

		/**pasar valor null por defecto */
		public function ShowAddView()
		{
			$resultadoAgregarCine = 4;
			require_once(VIEWS_PATH."add-cine.php");
		}

		public function ShowListView()
		{
			$cineList = $this->cineDAO->getAll();

			require_once(VIEWS_PATH."cine-list.php");
		}

		public function ShowFichaCine($nombre)
		{
			$cine = new Cine();

			$cine = $this->cineDAO->cineXnombre($nombre);

			$funciones = $this->funcionDAO->funcionesXcine($nombre);

			require_once(VIEWS_PATH."cine-ficha.php");
		}

		public function ShowModificarCine($nombre)
		{
			$cine= new Cine();

			$cine = $this->cineDAO->cineXnombre($nombre);

			require_once(VIEWS_PATH."cine-modificar.php");
		}

		public function eliminarCineYredirect ($nombre)
		{
			$this->cineDAO->eliminarCine($nombre);

			$this->funcionDAO->eliminarFuncionesXcine($nombre);

			$this->ShowListView();
		}

		public function actualizarUnCine($nombre, $direccion, $capacidad, $precio)
		{
			$cine = new Cine();
			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			$cine->setCapacidad($capacidad);
			$cine->setPrecio($precio);

			$this->cineDAO->actualizarUnCine($cine);

			$this->ShowFichaCine($nombre);
		}

		public function Add( $nombre, $direccion, $capacidad, $precio)
		{
			$cine = new Cine();

			$cine->setNombre($nombre);
			$cine->setDireccion($direccion);
			$cine->setCapacidad($capacidad);
			$cine->setPrecio($precio);

			$resultadoAgregarCine = $this->cineDAO->add($cine);

			require_once(VIEWS_PATH."add-cine.php");
		}


	}
?>