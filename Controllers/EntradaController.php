<?php
	namespace Controllers;

	use DAO\EntradaDAO as EntradaDAO;
	use Models\Entrada as Entrada;
	use DAO\CompraDAO as CompraDAO;
	use Models\Compra as Compra;
	use DAO\FuncionDAO as FuncionDAO;
	use Models\Funcion as Funcion;
	use DAO\PeliculaDAO as PeliculaDAO;
	use Models\Pelicula as Pelicula;
	use Models\Usuario as Usuario;

	class EntradaController extends Administrable
	{
		private $entradaDAO;
		private $compraDAO;
		private $funcionDAO;
		private $peliculaDAO;

		function __construct()
		{
			$this->entradaDAO = new EntradaDAO();
			$this->compraDAO = new CompraDAO();
			$this->funcionDAO = new FuncionDAO();
			$this->peliculaDAO = new PeliculaDAO();
		}

		public function ShowListView($idUsuario = null)
		{
			if(!$this->loggedIn()) Functions::redirect("Home");

			$entradaList = array();
			if($idUsuario != null)
			{
				$compraList = $this->compraDAO->getByUsuario($_SESSION['loggedUser']);
				foreach($compraList as $compra)
				{
					$entradasCompra = $this->entradaDAO->getByCompra($compra);
					$entradaList = array_merge($entradaList,$entradasCompra);
				}			
			}
			else
			{
				$entradaList = $this->entradaDAO->getAll();
			}
			$funcion = new Funcion();
			$pelicula = new Pelicula();
			require_once(VIEWS_PATH."entrada/entrada-list.php");
		}
	}
?>