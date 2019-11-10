<?php
    namespace Controllers;
    
    use DAO\PeliculaDAO as PeliculaDAO;
    use DAO\CineDAO as CineDAO;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Pelicula as Pelicula;
    use Models\Cine as Cine;

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

		public function Index()
		{
            $peliculaList = $this->peliculaDAO->getAll();
            $cineList = $this->cineDAO->getAll();
			require_once(VIEWS_PATH."estadistica/estadistica.php");
        }
        
        public function ReturnFunciones($idPelicula = null, $idCine = null)
		{
            if($idPelicula != "")
            {
                $pelicula = new Pelicula();
                $pelicula->setId($idPelicula);
            }

            if($idCine != "")
            {
                $cine = new Cine();
                $cine->setId($idCine);
            }            

            if(isset($idPelicula) && $idPelicula != null && isset($idCine) && $idCine != null)
            {
                $funcionList = $this->funcionDAO->getByCinePelicula($cine,$pelicula);
            }
            else if(isset($idPelicula) && $idPelicula != null)
            {
                $funcionList = $this->funcionDAO->getByPelicula($pelicula);
            }
            else if(isset($idCine) && $idCine != null)
            {
                $funcionList = $this->funcionDAO->getByCine($cine);
            }
            else
            {
                $funcionList = array();
            }
            echo json_encode($funcionList);
		}
	}
?>