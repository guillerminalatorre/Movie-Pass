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
		private $generoDAO;

		function __construct()
		{
			$this->generoDAO = new GeneroDAO();
		}
	}
?>