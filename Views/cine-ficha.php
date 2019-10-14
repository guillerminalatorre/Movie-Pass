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
    function borrarFuncion(id){
        preg = window.confirm('¿Desea borrar la funcion?');
        if(preg==true) 
        {
            alert('Se ha borrado la funcion '+ id);
        }
        return preg;
    }
</script>

<div class="container">
    <div>
        <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
        <br> 
        <br>  
        <table class="table table-sm table-dark">
            <thead >       
                <tr>
                <th scope="col" style="text-align:left">
                    <a class="btn btn-warning" onclick = "borrarCine('<?php echo $cine->getNombre(); ?>');">Eliminar Cine</a>
                </th>
                <th scope="col" style="text-align:center" >
                    <h1 class="display-2"><?php echo $cine->getNombre(); ?></h1>
                </th>
                <th scope="col" style="text-align:right">
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Cine/ShowModificarCine/<?php echo $cine->getNombre();?>">Modificar Cine</a>
                </th>
                </tr>
            </thead>
        </table>
        <table class="table table-striped table-dark">
        <tbody style="text-align:center" >
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


        <table class="table table-sm table-dark">
            <thead class="bg-success" >       
                <tr>
                     <th class="display-4" scope="col" style="text-align:center">Funciones</th>
                </tr>
            </thead>
        </table>
        <table class="table table-sm table-dark">
            <thead class="table-active">       
                <tr>
                    <th scope="col" style="text-align:center">Id</th>
                    <th scope="col" style="text-align:center">Pelicula</th>
                    <th scope="col" style="text-align:center">Fecha</th>
                    <th scope="col" style="text-align:center">Hora</th>
                    <th scope="col" style="text-align:center">Cant. Entradas</th>
                    <th scope="col" style="text-align:center">Cant. Vendidas</th>
                    <th scope="col" style="text-align:right">
                        <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Funcion/ShowAddView/<?php echo $cine->getNombre(); ?>">Agregar función</a>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <?php foreach ($funciones as $funcion) {
                    ?>
                    <tr>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getId();?></th>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getId_Pelicula();?></th>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getFecha();?></th>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getHora();?></th>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getCantEntradas();?></th>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getCantVendidas();?></th>
                    <th scope="col" style="text-align:right">
                    <a class="btn btn-danger" onclick = "if(borrarFuncion('<?php echo $funcion->getId();?>')) href='<?php echo FRONT_ROOT ?>Funcion/eliminarFuncionYredirect/<?php echo $funcion->getId(); ?>';">Eliminar Funcion</a>
                    </th>
                    </tr>
                    <?php } ?>
                </tr>
            </thead>
        </table>
    </div>
</div>