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
	
	class GeneroController
	{
		private $generoDAO;
	
		function __construct()
		{
			$this->generoDAO = new GeneroDAO();
		}
	
		public function getGenders(){
			$generos= $this->generoDAO->getAll();
		}
	
		public function getGendersFromApi()
		{
			$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);
	
			$get_data = APIController::callAPI('GET', API . '/genre/movie/list', $arrayReque);
	
			$arrayToDecode = json_decode($get_data, true);
	
			foreach ($arrayToDecode["genres"] as $categoryValues) {
				$category = new Genero();
				$category->setId($categoryValues["id"]);
				$category->setNombre($categoryValues["name"]);
				
				//TODO: VER EL MANEJO DE LA ACTUALIZACION DE LA TABLA   
				$this->generoDAO->add($category);
			}
		}
	}
?>