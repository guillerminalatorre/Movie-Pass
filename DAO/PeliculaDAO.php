<?php
	namespace DAO;

	use Models\Pelicula as Pelicula;
	use Models\Genero as Genero;
	use API\APIController as APIController;

	class PeliculaDAO
	{
		private $peliculaList = array();

		public function add(Pelicula $pelicula)
		{
			$this->RetrieveData();
		
			array_push($this->peliculaList, $pelicula);
		
			$this->SaveData();
		}

		function remove($id)
        {
            $this->RetrieveData();

            $this->peliculaList = array_filter($this->peliculaList, function($pelicula) use($id){
                return $pelicula->getId() != $id;
            });

            $this->SaveData();
		}

		public function getAll()
		{
			$this->Retrievedata();
		
			return $this->peliculaList;
		}

		public function getTotalPages()
		{
			return $this->totalPages;
		}

		public function SaveData()
		{
			$arrayToEncode = array();

			foreach($this->peliculaList as $pelicula)
			{
				$valuesArray["id"] = $pelicula->getId();
				$valuesArray["titulo"]= $pelicula->getTitulo();
				$valuesArray["generos"]= $pelicula->getGeneros();
				$valuesArray["duracion"]=$pelicula->getDuracion();
				$valuesArray["descripcion"]=$pelicula->getDescripcion();				
				$valuesArray["idioma"]= $pelicula->getIdioma();
				$valuesArray["clasificacion"]= $pelicula->getClasificacion();
				$valuesArray["actores"]=$pelicula->getActores();
				$valuesArray["fechaDeEstreno"]=$pelicula->getFechaDeEstreno();
				$valuesArray["poster"]= $pelicula->getPoster();
				$valuesArray["video"]= $pelicula->getVideo();				
				$valuesArray["popularidad"]=$pelicula->getPopularidad();
							
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			file_put_contents($jsonPath, $jsonContent);
		}

		public function RetrieveData()
		{
			$this->peliculaList = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$pelicula = new Pelicula();

					$pelicula->setId($valuesArray["id"]);
					$pelicula->setTitulo($valuesArray["titulo"]);
					foreach($valuesArray["generos"] as $genero)
					{
						$pelicula->agregarGenero($genero);
					}
					$pelicula->setDuracion($valuesArray["duracion"]);
					$pelicula->setDescripcion($valuesArray["descripcion"]);				
					$pelicula->setIdioma($valuesArray["idioma"]);
					$pelicula->setClasificacion($valuesArray["clasificacion"]);
					$pelicula->setActores($valuesArray["actores"]);
					$pelicula->setFechaDeEstreno($valuesArray["fechaDeEstreno"]);
					$pelicula->setPoster($valuesArray["poster"]);
					$pelicula->setVideo($valuesArray["video"]);				
					$pelicula->setPopularidad($valuesArray["popularidad"]);

					array_push($this->peliculaList, $pelicula);
				}
			}
		}

		public function getById($id)
        {
            $pelicula = null;

            $this->RetrieveData();

            $peliculas = array_filter($this->peliculaList, function($pelicula) use($id){
                return $pelicula->getId() == $id;
            });

            $peliculas = array_values($peliculas); //Reordering array indexes

            return (count($peliculas) > 0) ? $peliculas[0] : null;
		}
		
		public function getByTitulo($titulo)
        {
            $pelicula = null;

            $this->RetrieveData();

            $peliculas = array_filter($this->peliculaList, function($pelicula) use($titulo){
                return $pelicula->getTitulo() == $titulo;
            });

            $peliculas = array_values($peliculas); //Reordering array indexes

            return (count($peliculas) > 0) ? $peliculas[0] : null;
		}

		public function getNowPlayingMovies()
		{
			if (isset($_GET['page'])) 
			{
				$pageValue = $_GET['page'];
			} 
			else 
			{
				$pageValue = 1;
			}
		
			$arrayReque=array("api_key"=>API_KEY, "language"=>LANGUAGE_ES, "region"=>"AR", "page"=>$pageValue);

			$get_data = APIController::callAPI('GET', API .'/movie/now_playing', $arrayReque);

			$arrayToDecode = json_decode($get_data, true);

			foreach($arrayToDecode["results"] as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setPoster($valuesArray["poster_path"]);				
				$pelicula->setIdioma($valuesArray["original_language"]);
				$pelicula->setClasificacion($valuesArray["adult"]);

				foreach($valuesArray["genre_ids"] as $genero)
				{
					$pelicula->agregarGenero($genero);
				}

				$pelicula->setTitulo($valuesArray["title"]);
				$pelicula->setPopularidad($valuesArray["vote_average"]);
				$pelicula->setDescripcion($valuesArray["overview"]);
				$pelicula->setFechaDeEstreno($valuesArray["release_date"]);				

				if($valuesArray["video"]!==false)
				{
					$pelicula->setVideo($valuesArray["video"]);
				}

				array_push($this->peliculaList, $pelicula);
			}
			$this->totalPages=$arrayToDecode["total_pages"];
			return $this->peliculaList;
		}

		public function getFilteredMovies($id)
		{
			if (isset($_GET['page'])) 
			{
				$pageValue = $_GET['page'];
			} 
			else 
			{
				$pageValue = 1;
			}

			$actualDate=date("Y-m-d");

			$arrayReque=array("api_key"=>API_KEY, "language"=>LANGUAGE_ES, "include_video"=>true,"with_genres"=>$id,"primary_release_date.lte"=>date("Y-m-d", strtotime($actualDate . "+ 5 days")),"primary_release_date.gte"=> date("Y-m-d", strtotime($actualDate . "- 2 month")),"sort_by"=>"primary_release_date.desc", "with_original_language"=>"es,en");

			$get_data = APIController::callAPI('GET', API .'/discover/movie', $arrayReque);

			$arrayToDecode = json_decode($get_data, true);

			foreach($arrayToDecode["results"] as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setPoster($valuesArray["poster_path"]);
				$pelicula->setId($valuesArray["id"] );
				$pelicula->setIdioma($valuesArray["original_language"]);

				foreach($valuesArray["genre_ids"] as $genero)
				{
					$pelicula->agregarGenero($genero);
				}

				$pelicula->setTitulo($valuesArray["title"]);
				$pelicula->setPopularidad($valuesArray["vote_average"]);
				$pelicula->setDescripcion($valuesArray["overview"]);
				$pelicula->setFechaDeEstreno($valuesArray["release_date"]);				

				if($valuesArray["video"]!==false)
				{
					$pelicula->setVideo($valuesArray["video"]);
				}				
				array_push($this->peliculaList, $pelicula);
			}
			$this->totalPages=$arrayToDecode["total_pages"];
			return $this->peliculaList;
		}
		
		//Need this function to return correct file json path
		function GetJsonFilePath(){

			$initialPath = "Data\peliculas.json";
			
			if(file_exists($initialPath)){
				$jsonFilePath = $initialPath;
			}else{
				$jsonFilePath = ROOT.$initialPath;
			}
			
			return $jsonFilePath;
		}
	}
?>
