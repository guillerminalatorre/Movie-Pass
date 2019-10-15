<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use Models\Funcion as Funcion;
	use Models\Genero as Genero;
	use Models\Pelicula as Pelicula;
	use DAO\PeliculaDAO as PeliculaDAO;

	class FuncionDAO
	{
		private $funcionList = array();

		/**
		 * 
		 * @param funcion
		 */
		public function add(Funcion $funcion)
		{
			$this->retrieveData();

			array_push($this->funcionList, $funcion);
				
			$this->saveData();
		}

		function remove($id)
        {
            $this->RetrieveData();

            $this->funcionList = array_filter($this->funcionList, function($funcion) use($id){
                return $funcion->getId() != $id;
            });

            $this->SaveData();
        }

		public function getAll()
		{
			$this->Retrievedata();

			return $this->funcionList;
		}

		public function SaveData()
		{
			$arrayToEncode = array();

			foreach($this->funcionList as $funcion)
			{
				$valuesArray["id"] = $funcion->getId();
				$valuesArray["nombre_Cine"]= $funcion->getNombre_Cine();
				$valuesArray["fecha"]= $funcion->getFecha();
				$valuesArray["hora"]=$funcion->getHora();
				$valuesArray["id_Pelicula"]=$funcion->getId_Pelicula();
				$valuesArray["cantEntradas"]=$funcion->getCantEntradas();
				$valuesArray["cantVendidas"]=$funcion->getCantVendidas();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			file_put_contents($jsonPath, $jsonContent);
		}

		public function RetrieveData()
		{
			$this->funcionList = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombre_Cine($valuesArray["nombre_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					array_push($this->funcionList, $funcion);
				}
			}
		}

		/**
		*retorna un arrgelo con las funciones que cumplen la condicion
		*/
		public function funcionesAptasFecha(string $fecha)
		{
			$this->funcionList = array();

			$busqueda = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombre_Cine($valuesArray["Nombre_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					if($fecha === $funcion->getFecha() || $funcion->getCantEntradas() > $funcion->getCantVendidas())
					{
						array_push($busqueda, $funcion);
					}
				}
			}

			return $busqueda;
		}

		
		public function funcionesAptasFechayGenero(string $fecha, int $id_Genero)
		{
			$this->funcionList = array();

			$peliculaDAO = new PeliculaDAO();

			$busqueda = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombre_Cine($valuesArray["nombre_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					$pelicula = new Pelicula();
					$pelicula = $peliculaDAO->getPelicula($funcion->getId_Pelicula());

					$generos = array();
					$generos = $pelicula->getGeneros();
					
					foreach($generos as $gen)
					{
						if( $gen->idGenero() === $idGenero && $funcion->getCantEntradas() > $funcion->getCantVendidas() && $fecha === $funcion->getFecha())
						{
							array_push($busqueda, $funcion);
						}
					}
					
				}
			}

			return $busqueda;
		}

		/**
		*preCondicion: utilizacion de la funcion de $genero->generoExist();
		*/
		public function funcionesAptasGenero(int $idGenero)
		{
			$this->funcionList = array();

			$peliculaDAO = new PeliculaDAO();

			$busqueda = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombre_Cine($valuesArray["nombre_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					$pelicula = new Pelicula();
					$pelicula = $peliculaDAO->getPelicula($funcion->getId_Pelicula());

					$generos = array();
					$generos = $pelicula->getGeneros();
					
					foreach($generos as $gen)
					{
						if( $gen->idGenero() === $idGenero && $funcion->getCantEntradas() > $funcion->getCantVendidas())
						{
							array_push($busqueda, $funcion);
						}
					}					
				}
			}
			return $busqueda;
		}

		/**
		* retorna true si se pudieron agregar, false si no;
		*/
		public function agregarEntradasVendidas(int $nuevasEntradasVendidas, int $idFuncion)
		{
			$this->funcionList = array();

			$rta = false;

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombre_Cine($valuesArray["nombre_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					if($idFuncion == $funcion->getId())
					{
						$rta = $funcion->agregarEntradasVendidas($nuevasEntradasVendidas);

						array_push($funcionList, $funcion);
					}
					else 
					{
						array_push($funcionList, $funcion);
					}
				}

				$this->SaveData();
			}
			return $rta;
		}

		public function getById($id)
        {
            $funcion = null;

            $this->RetrieveData();

            $funciones = array_filter($this->funcionList, function($funcion) use($id){
                return $funcion->getId() == $id;
            });

            $funciones = array_values($funciones); //Reordering array indexes

            return (count($funciones) > 0) ? $funciones[0] : null;
        }

		public function getByCine($nombre_Cine)
        {
            $funcion = null;

            $this->RetrieveData();

            $funciones = array_filter($this->funcionList, function($funcion) use($nombre_Cine){
                return $funcion->getNombre_Cine() == $nombre_Cine;
            });

            $funciones = array_values($funciones); //Reordering array indexes

            return (count($funciones) > 0) ? $funciones : null;
        }

		public function eliminarGetByCine($nombreCine)
		{
			$this->funcionList = array();

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setNombre_Cine($valuesArray["nombre_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					if($nombreCine != $funcion->getNombre_Cine())
					{
						array_push($this->funcionList, $funcion);
					}
				}

			}
			$this->SaveData();
		}

		public function iDdisponible()
		{
			$rta = 0;

			$jsonPath = $this->GetJsonFilePath(); //Get correct json path

			if(file_exists($jsonPath));
			{
				$jsonContent = file_get_contents($jsonPath);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);

					$rta = $funcion->getId();
				}
			}
			$rta++;
			
			return $rta;
		}

		//Need this function to return correct file json path
		function GetJsonFilePath(){

			$initialPath = "Data\\funciones.json";
			
			if(file_exists($initialPath)){
				$jsonFilePath = $initialPath;
			}else{
				$jsonFilePath = ROOT.$initialPath;
			}
			
			return $jsonFilePath;
		}
	}
?>