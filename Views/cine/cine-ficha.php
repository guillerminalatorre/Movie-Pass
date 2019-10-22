<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid mt-4">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <table class="table table-sm table-light">
            <thead >       
                <tr>
                <th scope="col" style="text-align:left">
                    <a class="btn btn-warning" onclick = "if(borrarCine('<?php echo $cine->getNombre(); ?>')) href='<?php echo FRONT_ROOT ?>Cine/eliminarCine/<?php echo $cine->getNombre(); ?>' ;">Eliminar Cine</a>
                </th>
                <th scope="col" style="text-align:center" >
                    <h1 class="display-2"><?php echo $cine->getNombre(); ?></h1>
                </th>
                <th scope="col" style="text-align:right">
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Cine/ShowEditView/<?php echo $cine->getNombre();?>">Modificar cine</a>
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
        <?php require_once("funcion-list.php"); ?>
    </div>
</div>