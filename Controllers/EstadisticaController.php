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
            $funcionList = $this->funcionDAO->getAll();
            $pelicula = new Pelicula();
			require_once(VIEWS_PATH."estadistica/estadistica.php");
        }
	}
?>