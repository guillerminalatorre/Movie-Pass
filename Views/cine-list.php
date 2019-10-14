<?php

if (isset($_SESSION["loggedUser"])) {

    if ($_SESSION["loggedUser"]->getId_Rol() === 2) {

        require_once "main-admin-navbar.php";
    } else if ($_SESSION["loggedUser"]->getId_Rol() === 3) {

        require_once "admin-navbar.php";
    } else

        header("Location: ../Pelicula/ShowAddView");
} else {
    header("Location: ../Usuario/ShowLoginView");
}
/*Los ultimos 2 headers son para reestringir entradas de no Admins*/

?>


<div class="container container-fluid mt-4">
    <h2>Selecciona un cine para operar: </h2>
    <?php foreach ($cineList as $cine) { ?>
        <a class="btn btn-info btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaCine/<?php echo $cine->getNombre(); ?>"><?php echo $cine->getNombre(); ?></button>
            <hr>
        <?php } ?>

        <a class="btn btn-success btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fas fa-plus-circle"></i> Agregar cine</a>
</div>