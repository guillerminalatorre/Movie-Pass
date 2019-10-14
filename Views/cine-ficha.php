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

<script>
    function borrar(nombre) {
        preg = window.confirm('¿Desea borrar el cine ' + nombre + '?');
        if (preg == true) {
            alert('Se ha borrado el cine ' + nombre);
            location.href = "<?php echo FRONT_ROOT ?>Cine/eliminarCineYredirect/<?php echo $cine->getNombre(); ?>";
        }
    }
</script>

<div class="container container-fluid mt-4">
    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
    <h2>Ficha de Cine</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="text-align:left">
                    <a class="btn btn-warning" onclick="borrar('<?php echo $cine->getNombre(); ?>');">Eliminar Cine</a>
                </th>
                <th scope="col" style="text-align:center">
                    <h1><?php echo $cine->getNombre(); ?></h1>
                </th>
                <th scope="col" style="text-align:right">
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Cine/ShowModificarCine/<?php echo $cine->getNombre(); ?>">Modificar Cine</a>
                </th>
            </tr>
        </thead>
    </table>
    <table class="table table-striped">
        <tbody style="text-align:center">
            <tr>
                <th scope="row">Dirección</th>
                <td><?php echo $cine->getDireccion(); ?></td>
            </tr>
            <tr>
                <th scope="row">Capacidad</th>
                <td><?php echo $cine->getCapacidad(); ?> personas </td>
            </tr>
            <tr>
                <th scope="row">Precio</th>
                <td>$<?php echo $cine->getPrecio(); ?></td>
            </tr>
        </tbody>
    </table>
</div>