<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\GeneroDAO as GeneroDAO;
	use Models\Genero as Genero;

	class GeneroController
	{
		private $generosDAO;

		function __construct()
		{
			$this->generosDAO = new GeneroDAO();
		}

		public function ShowGenreView($message = "")
		{
			$generoList = $this->generosDAO->getAll();
			require_once(VIEWS_PATH."searchbar.php");
		}
	}
?>