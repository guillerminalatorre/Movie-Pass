<?php

	namespace DAO;

	use Models\Pelicula as Pelicula;
	use Models\Genero as Genero;

	class PeliculaDAO
	{
		private $peliculaList = array();

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

		/**
		 *  retorna 0 si no existe, la id si existe
		 * 
		 * @param peliculaAbuscar busca por id, por titulo y por fecha.
-		 */
		public function peliculaExists(Pelicula $peliculaAbuscar)
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

					if($peliculaAbuscar->getId() === $pelicula->getId())
					{
						return $pelicula->getId();
					}
					if($peliculaAbuscar->getTitulo() === $pelicula->getTitulo())
					{
						return $pelicula->getId();
					}
					if($peliculaAbuscar->getFecha() === $pelicula->getFecha())
					{
						return $pelicula->getId();
					}
				}
			}	
			return 0;
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

	public function getByGenre($id)
    { 
        $this->getCurl($id);
        return $this->peliculaList;
    }

	private function getCurl($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?api_key=6a65158231eaaf71a3446b747cff20ec&language=es&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&without_genres=".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $arrayToDecode = ($response) ? json_decode($response, true) : array();

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
					$pelicula->setClasificacion($valuesArray["vote_average"]);
					$pelicula->setDescripcion($valuesArray["overview"]);
					$pelicula->setFechaDeEstreno($valuesArray["release_date"]);				

					if($valuesArray["video"]!==false)
					{
						$pelicula->setVideo($valuesArray["video"]);
					}

                array_push($this->peliculaList, $pelicula);
            }
        }
    }
}
?>