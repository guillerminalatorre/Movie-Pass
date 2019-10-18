<?php
	namespace DAO;

	use Models\Pelicula as Pelicula;
	use Models\Genero as Genero;
	use API\APIController as APIController;

	class PeliculaDAO
	{
		private $peliculaList = array();
		private $totalPages;

		public function getNumberOfTotalPages()
		{
			return $this->totalPages;
		}

		public function add(Pelicula $pelicula)
		{
			$this->RetrieveData();
		
			array_push($this->peliculaList, $pelicula);
		
			$this->SaveData();
		}

		public function getAll()
		{
			$this->Retrievedata();
		
			return $this->peliculaList;
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
				$valuesArray["idioma"]=$pelicula->getIdioma();
				$valuesArray["clasificacion"]=$pelicula->getClasificacion();
				$valuesArray["actores"]=$pelicula->getActores();
				
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			file_put_contents("Data/peliculas.json", $jsonContent);
		}

		public function RetrieveData()
		{
			$this->peliculaList = array();

			if(file_exists("Data/peliculas.json"));
			{
				$jsonContent = file_get_contents("Data/peliculas.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$pelicula = new Pelicula();
					$pelicula->setId($valuesArray["id"] );
					$pelicula->setTitulo($valuesArray["titulo"] );
					$pelicula->setGeneros($valuesArray["generos"] );
					$pelicula->setDuracion($valuesArray["duracion"]);
					$pelicula->setDescripcion($valuesArray["descripcion"]);
					$pelicula->setIdioma($valuesArray["idioma"]);
					$pelicula->setClasificacion($valuesArray["clasificacion"]);
					$pelicula->setActores($valuesArray["actores"]);

					array_push($this->peliculaList, $pelicula);
				}
			}
		}

		public function getPelicula(int $id)
		{
			$this->peliculaList = array();

			if(file_exists("Data/peliculas.json"));
			{
				$jsonContent = file_get_contents("Data/peliculas.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$pelicula = new Pelicula();
					$pelicula->setId($valuesArray["id"] );
					$pelicula->setTitulo($valuesArray["titulo"] );
					$pelicula->setGeneros($valuesArray["generos"] );
					$pelicula->setDuracion($valuesArray["duracion"]);
					$pelicula->setDescripcion($valuesArray["descripcion"]);
					$pelicula->setIdioma($valuesArray["idioma"]);
					$pelicula->setClasificacion($valuesArray["clasificacion"]);
					$pelicula->setActores($valuesArray["actores"]);

					if($pelicula->getId() === $id)
					{
						return $pelicula;
					}
				}
			}	
			return null;
		}

		public function peliculasXGenero(string $genero)
		{
			$this->peliculaList = array();

			$busqueda = array();

			if(file_exists("Data/peliculas.json"));
			{
				$jsonContent = file_get_contents("Data/peliculas.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$pelicula = new Pelicula();
					$pelicula->setId($valuesArray["id"] );
					$pelicula->setTitulo($valuesArray["titulo"] );
					$pelicula->setGeneros($valuesArray["generos"] );
					$pelicula->setDuracion($valuesArray["duracion"]);
					$pelicula->setDescripcion($valuesArray["descripcion"]);
					$pelicula->setIdioma($valuesArray["idioma"]);
					$pelicula->setClasificacion($valuesArray["clasificacion"]);
					$pelicula->setActores($valuesArray["actores"]);

					$generos = array();
					$generos = $pelicula->getGeneros();
					foreach ($generos as $gen){
						
						if($gen === $genero)
						{
							array_push($busqueda, $pelicula);
						}
					}
				}
			}	
			return $busqueda;
		}

		public function eliminarPelicula(int $id)
		{
			$this->peliculaList = array();

			if(file_exists("Data/peliculas.json"));
			{
				$jsonContent = file_get_contents("Data/peliculas.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$pelicula = new Pelicula();
					$pelicula->setId($valuesArray["id"] );
					$pelicula->setTitulo($valuesArray["titulo"] );
					$pelicula->setGeneros($valuesArray["generos"] );
					$pelicula->setDuracion($valuesArray["duracion"]);
					$pelicula->setDescripcion($valuesArray["descripcion"]);
					$pelicula->setIdioma($valuesArray["idioma"]);
					$pelicula->setClasificacion($valuesArray["clasificacion"]);
					$pelicula->setActores($valuesArray["actores"]);

					if($id != $pelicula->getId())
					{
						array_push($this->peliculaList, $pelicula);
					}
				}
				$this->SaveData();
			}
				
		}

		public function getNowPlayingMovies()
		{
			if (isset($_GET['page'])) {
				$pageValue = $_GET['page'];
			} else {
				$pageValue = 1;
			}
		
			$arrayReque=array("api_key"=>API_KEY, "language"=>LANGUAGE_ES, "region"=>"AR", "page"=>$pageValue);

			$get_data = APIController::callAPI('GET', API .'/movie/now_playing', $arrayReque);

			$arrayToDecode = json_decode($get_data, true);

			foreach($arrayToDecode["results"] as $valuesArray)
			{
				$pelicula = new Pelicula();
				$pelicula->setPoster($valuesArray["poster_path"]);
				$pelicula->setId($valuesArray["id"] );
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

		public function getMoviesByGender($id)
		{
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
	}
?>
