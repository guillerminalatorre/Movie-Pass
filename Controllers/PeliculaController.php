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
			$this->peliculasDAO = new PeliculaDAO();
		}

		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "");
		}

		public function ShowListView()
		{
			$peliculaList = $this->PeliculasDAO->getAll();

			require_once(VIEWS-PATH."");
		}

		public function Add($id, $titulo, $generos, $duracion, $descripcion, $idioma, $clasificacion, $actores)
		{
			$pelicula = new Pelicula($id, $titulo, $generos, $duracion, $descripcion,$idioma, $clasificacion, $actores);

			$this->peliculasDAO->add($pelicula);

			$this->ShowAddView();
		}
	}
?>