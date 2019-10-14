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

		public function getAll()
		{
			$this->Retrievedata();

			return $this->funcionList;
		}

		public function SaveAll()
		{
			
			$arrayToEncode = array();

			foreach($this->funcionList as $funcion)
			{
				$valuesArray["id"] = $funcion->getId();
				$valuesArray["id_Cine"]= $funcion->getId_Cine();
				$valuesArray["fecha"]= $funcion->getFecha();
				$valuesArray["hora"]=$funcion->getHora();
				$valuesArray["id_Pelicula"]=$funcion->getId_Pelicula();
				$valuesArray["cantEntradas"]=$funcion->getCantEntradas();
				$valuesArray["cantVendidas"]=$funcion->getCantVendidas());
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			file_put_contents("Data/funciones.json", $jsonContent);
		}

		public function RetrieveData()
		{
			$this->funcionList = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
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
		 * retorna 0 si no existe, la id si existe
		 * @param funcion debe tener alguno de sus atributos completos
		 */
		public function funcionExists(Funcion $funcionAbuscar)
		{
			$this->funcionList = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					if($funcionAbuscar->getId() === $funcion->getId())
					{
						return $funcion->getId();
					}
					if($funcionAbuscar->getId_Cine() === $funcion->getId_Cine())
					{
						return $funcion->getId();
					}
					if($funcionAbuscar->getId_Pelicula() === $funcion->getId_Pelicula())
					{
						return $funcion->getId();
					}
					if($funcionAbuscar->getFecha() === $funcion->getFecha())
					{
						return $funcion->getId();
					}
					if($funcionAbuscar->getHora() === $funcion->getHora())
					{
						return $funcion->getId();
					}
				}
			}
			return 0;
		}

		/**
		 * 
		 * @param id
		 */
		public function eliminarFuncion(int $id)
		{
			$this->funcionList = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					if($id != $funcion->getId())
					{
						array_push($this->funcionList, $funcion);
					}
				}

				$this->SaveData();
			}
		}

		/**
		*retorna un arrgelo con las funciones que cumplen la condicion
		*/
		public function funcionesAptasFecha (string $fecha)
		{
			$this->funcionList = array();

			$busqueda = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
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

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					$pelicula = new Pelicula();
					$pelicula = $peliculaDAO->getPelicula($funcion->getId_Pelicula());

					$generos = array();
					$generos = $pelicula->getGeneros();
					
					for($generos as $gen)
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
		public function funcionesAptasGenero (int $idGenero)
		{
			$this->funcionList = array();

			$peliculaDAO = new PeliculaDAO();

			$busqueda = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					$pelicula = new Pelicula();
					$pelicula = $peliculaDAO->getPelicula($funcion->getId_Pelicula());

					$generos = array();
					$generos = $pelicula->getGeneros();
					
					for($generos as $gen)
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
		*retorna false si no hay disponibilidad para esa cantidad, true si sí.
		*/
		public function hayEntradasDisponibles (int $idFuncion, int $cantEntradasSolicitadas)
		{
			$this->funcionList = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
					$funcion->setFecha($valuesArray["fecha"]);
					$funcion->setHora($valuesArray["hora"]);
					$funcion->setId_Pelicula($valuesArray["id_Pelicula"]);
					$funcion->setCantEntradas($valuesArray["cantEntradas"]);
					$funcion->setCantVendidas($valuesArray["cantVendidas"]);

					if($funcion->getId() === $idFuncion)
					{
						if($funcion->getCantEntradas() > ($funcion->cantVendidas() + $cantEntradasSolicitadas))
						{
							return true;
						}
						else 
						{
							return false;	
						}
					}
				}
			}

			return false;
		}

		/**
		* retorna true si se pudieron agregar, false si no;
		*/
		public function agregarEntradasVendidas(int $nuevasEntradasVendidas, int $idFuncion)
		{
			$this->funcionList = array();

			$rta = false;

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$funcion = new Funcion();
					$funcion->setId($valuesArray["id"]);
					$funcion->setId_Cine($valuesArray["id_Cine"]);
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

		public function funcionesXCine($nombreCine)
		{
			$rta = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

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

					if($nombreCine == $funcion->getNombre_Cine())
					{
						array_push($rta, $funcion);
					}
				}

			}
			return $rta;
		}

		public function eliminarFuncionesXcine($nombreCine)
		{
			$this->funcionList = array();

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

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

			if(file_exists("Data/funciones.json"));
			{
				$jsonContent = file_get_contents("Data/funciones.json");

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
	}
?>