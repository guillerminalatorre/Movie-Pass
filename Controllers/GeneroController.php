<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use API\APIController as APIController;
	use DAO\GeneroDAO as GeneroDAO;
	use Models\Genero as Genero;
	use Config\Functions as Functions;
	
	class GeneroController
	{
		private $generoDAO;
	
		function __construct()
		{
			$this->generoDAO = new GeneroDAO();
		}
	
		public function getGenresFromApi()
		{
			$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);
	
			$get_data = APIController::callAPI('GET', API . '/genre/movie/list', $arrayReque);
	
			$arrayToDecode = json_decode($get_data, true);
	
			foreach ($arrayToDecode["genres"] as $categoryValues) 
			{
				$category = new Genero();
				$category->setId($categoryValues["id"]);
				$category->setNombre($categoryValues["name"]);
				   
				$this->generoDAO->add($category);
			}
		}
	}
?>