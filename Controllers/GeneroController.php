<?php
	namespace Controllers;

	use API\TMDBController as TMDBController;
	use DAO\GeneroDAO as GeneroDAO;
	use Models\Genero as Genero;
	
	class GeneroController extends Administrable
	{
		private $generoDAO;
	
		function __construct()
		{
			$this->generoDAO = new GeneroDAO();
		}
	
		public function getGenresFromApi()
		{
			if(!$this->loggedIn()) Functions::redirect("Home");
			if(!$this->isMainAdmin()) Functions::redirect("Home");

			$arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);
	
			$get_data = TMDBController::callAPI('GET', API . '/genre/movie/list', $arrayReque);
	
			$arrayToDecode = json_decode($get_data, true);
	
			$count = 0;
			foreach ($arrayToDecode["genres"] as $generoValues) 
			{
				$genero = new Genero();
				$genero->setId($generoValues["id"]);
				$genero->setNombre($generoValues["name"]);
				if($this->generoDAO->getGenero($genero) != null) continue;
					
				if($this->generoDAO->add($genero))
				{
					Functions::flash("Se agrego el genero ".$genero->getNombre().".");
					$count++;
				}					
				else Functions::flash("Hubo un error al agregar un genero.","danger");
			}
			if($count > 0) Functions::flash("Se agregaron ".$count." generos correctamente.","info");
			else Functions::flash("No existen mas generos para agregar de la API.","warning");

			Functions::redirect("System");
		}
	}
?>