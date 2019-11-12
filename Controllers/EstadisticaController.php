<?php
    namespace Controllers;
    
    use DAO\EstadisticaDAO as EstadisticaDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use DAO\CineDAO as CineDAO;
    use DAO\SalaDAO as SalaDAO;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Pelicula as Pelicula;
    use Models\Cine as Cine;
    use Models\Sala as Sala;
    use Models\Funcion as Funcion;

	class EstadisticaController
	{
        private $estadisticaDAO;
        private $peliculaDAO;
        private $cineDAO;
        private $salaDAO;
        private $funcionDAO;

        function __construct()
        {
            $this->estadisticaDAO = new EstadisticaDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
        }

		public function Index($idPelicula = null, $idCine = null, $idFuncion = null, $fechaInicio = null, $fechaFin = null)
		{
            if($idPelicula != null) $idPelicula = Functions::validateData($idPelicula);
            if($idCine != null) $idCine = Functions::validateData($idCine);
            if($idFuncion != null) $idFuncion = Functions::validateData($idFuncion);
            if($fechaInicio != null) $fechaInicio = Functions::validateData($fechaInicio);
            if($fechaFin != null) $fechaFin = Functions::validateData($fechaFin);

            $pelicula = new Pelicula();
            $cine = new Cine();
            $funcion = new Funcion();
            $sala = new Sala();

            $peliculaList = $this->peliculaDAO->getAll();
            $cineList = $this->cineDAO->getAll();

            // Cargar datos en el formulario de los parametros que recibo
            if($idPelicula != null)
            {
                $pelicula->setId($idPelicula);
                $pelicula = $this->peliculaDAO->getPelicula($pelicula);
            }
            if($idCine != null)
            {
                $cine->setId($idCine);
                $cine = $this->cineDAO->getCine($cine);
            }
            if($idFuncion != null)
            {
                $funcion->setId($idFuncion);
                $funcion = $this->funcionDAO->getFuncion($funcion);
            }
            if($fechaInicio != null)
            {
                $timeInicio = strtotime($fechaInicio);
            }
            if($fechaFin != null)
            {
                $timeFin = strtotime($fechaFin);
            }
            if($fechaInicio != null && $fechaFin != null && $timeInicio > $timeFin)
            {
                $timeInicio = $timeFin;
                Functions::flash("Ese rango de tiempo no existe. Se modifico para solucionarlo.","warning");
            }

            // Load funciones en base a pelicula y cine
            if($idPelicula != null && $idCine != null)
            {
                $funcionList = $this->funcionDAO->getByCinePelicula($cine,$pelicula);
            }
            else if($idPelicula != null)
            {
                $funcionList = $this->funcionDAO->getByPelicula($pelicula);
            }
            else if($idCine != null)
            {
                $funcionList = $this->funcionDAO->getByCine($cine);
            }
            else
            {
                $funcionList = $this->funcionDAO->getAll();
            }

            // Inicio estadisticas
            if($idFuncion != null) $count = 1;
            else $count = count($funcionList);

            $vendidas = 0;
            $remanente = 0;
            $capacidad = 0;
            $recaudacion = 0;
            $perdida = 0;
            if($count > 0)
            {
                if($idFuncion != null)
                {
                    $vendidas += $this->estadisticaDAO->getCantidadVendidaFuncion($funcion);
                    $remanente += $this->estadisticaDAO->getRemanenteFuncion($funcion);
                    $capacidad += $vendidas+$remanente;
                    $recaudacion += $this->estadisticaDAO->getRecaudacionFuncion($funcion);

                    $sala->setId($funcion->getIdSala());
                    $sala = $this->salaDAO->getSala($sala);
                    $precio = $sala->getPrecio();

                    $perdida += $remanente * $precio;
                }
                else
                {
                    foreach($funcionList as $funcion)
                    {
                        $vendidas += $this->estadisticaDAO->getCantidadVendidaFuncion($funcion);
                        $remanente += $this->estadisticaDAO->getRemanenteFuncion($funcion);
                        $capacidad += $vendidas+$remanente;
                        $recaudacion += $this->estadisticaDAO->getRecaudacionFuncion($funcion);
                                             
                        $sala->setId($funcion->getIdSala());
                        $sala = $this->salaDAO->getSala($sala);
                        $precio = $sala->getPrecio();

                        $perdida += $remanente * $precio;
                    }
                }
            }
            // Fin estadisticas

			require_once(VIEWS_PATH."estadistica/estadistica.php");
        }
	}
?>