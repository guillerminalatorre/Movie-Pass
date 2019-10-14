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
    <h2>Selecciona un usuario para operar:</h2>
    <?php foreach ($usuarioList as $usuario) { ?>
        <button type="button" class="btn btn-info btn-block" href="ficha-cine.php" value="<?php $usuario->getId(); ?>"><?php echo $usuario->getApellido(); ?>, <?php echo $usuario->getNombre(); ?></button>
        <hr>
    <?php } ?>
</div>