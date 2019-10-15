<?php if (!isset($_SESSION["loggedUser"]) || $_SESSION["loggedUser"]->getId_Rol() === 1) {
    header("Location: " . FRONT_ROOT . "Pelicula/ShowMovies");
}
?>