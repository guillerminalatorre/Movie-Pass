<?php
    namespace Controllers;
    
    use DAO\PeliculaDAO as PeliculaDAO;
    use DAO\CineDAO as CineDAO;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Pelicula as Pelicula;
    use Models\Cine as Cine;
    use Models\Funcion as Funcion;

	class EstadisticaController
	{
        private $peliculaDAO;
        private $cineDAO;
        private $funcionDAO;

        function __construct()
        {
            $this->peliculaDAO = new PeliculaDAO();
            $this->cineDAO = new CineDAO();
            $this->funcionDAO = new FuncionDAO();
        }

		public function Index($idPelicula = null, $idCine = null, $idFuncion = null, $fechaInicio = null, $fechaFin = null)
		{
            $pelicula = new Pelicula();
            $cine = new Cine();
            $funcion = new Funcion();

            $peliculaList = $this->peliculaDAO->getAll();
            $cineList = $this->cineDAO->getAll();

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
            else
            {
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
            }

            if($fechaInicio != null)
            {

            }

            if($fechaFin != null)
            {

            }

			require_once(VIEWS_PATH."estadistica/estadistica.php");
        }

        public function CalcularEstadisticas($idPelicula = null, $idCine = null, $idFuncion = null, $fechaInicio = null, $fechaFin = null)
        {

        }
	}
?>