<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\PeliculaDAO as PeliculaDAO;
	use Models\Pelicula as Pelicula;

	class PeliculaController
	{
		private $peliculaDAO;

		function __construct()
		{
			$this->peliculaDAO = new PeliculaDAO();
		}

		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "searchbar.php");
		}

		public function ShowFilteredMovies($id){
			$peliculaList= $this->peliculaDAO->getByGenre($id);

			require_once(VIEWS_PATH."listarpeliculas.php");
		}
	}
?>