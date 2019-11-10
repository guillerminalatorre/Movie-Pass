<?php
    namespace Controllers;

    use Models\Sala as Sala;
    use Models\Funcion as Funcion;
    use Models\Cine as Cine;
    use Models\Pelicula as Pelicula;
    use Models\Entrada as Entrada;
    use DAO\SalaDAO as SalaDAO;
    use DAO\FuncionDAO as FuncionDAO;
    use DAO\CineDAO as CineDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use DAO\GeneroDAO as GeneroDAO;
    use DAO\EntradaDAO as EntradaDAO;

    class SalaController extends Administrable
    {
        private $salaDAO;
        private $funcionDAO;
        private $cineDAO;
        private $peliculaDAO;
        private $generoDAO;
        private $entradaDAO;

        function __construct()
        {
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
            $this->cineDAO = new CineDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->generoDAO = new GeneroDAO();
            $this->entradaDAO = new EntradaDAO();
        }

        public function ShowAddView($idCine)
        {
            if (!$this->loggedIn()) Functions::redirect("Home");
            if (!$this->isAdmin()) Functions::redirect("Home");

            $cine = new Cine();
            $cine->setId($idCine);
            $cine = $this->cineDAO->getCine($cine);
            require_once(VIEWS_PATH . "sala/sala-add.php");
        }

        public function Remove($id)
        {
            if (!$this->loggedIn()) Functions::redirect("Home");
            if (!$this->isAdmin()) Functions::redirect("Home");

            $id = Functions::validateData($id);

            $sala = new Sala();
            $sala->setId($id);
            $sala = $this->salaDAO->getSala($sala);

            $idCine = $sala->getIdCine();

            if($this->salaDAO->remove($sala) != null) Functions::flash("La sala se ha eliminado correctamente.","success");
            else Functions::flash("Hubo un error al eliminar la sala.","danger");
            Functions::redirect("Cine", "ShowFichaView", $idCine);
        }

        public function Add($idCine, $nombre, $precio, $capacidad)
        {
            if (!$this->loggedIn()) Functions::redirect("Home");
            if (!$this->isAdmin()) Functions::redirect("Home");

            $idCine = Functions::validateData($idCine);
            $nombre = Functions::validateData($nombre);
            $precio = Functions::validateData($precio);
            $capacidad = Functions::validateData($capacidad);

            $sala = new Sala();
            $sala->setIdCine($idCine);
            $sala->setNombre($nombre);
            $sala->setPrecio($precio);
            $sala->setCapacidad($capacidad);

            if($this->salaDAO->add($sala) != null) Functions::flash("La sala se ha agregado correctamente.","success");
            else Functions::flash("Hubo un error al agregar la sala.","danger");
            Functions::redirect("Cine", "ShowFichaView", $idCine);
        }
    }
?>
