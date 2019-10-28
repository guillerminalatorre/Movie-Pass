<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container mb-4">
    <div class="row">
        <div class="col-sm bg-light rounded p-4 text-center mr-4 shadow">

            <!-- Volver a lista cines -->
            <div><a class="btn btn-secondary mb-4 shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Ver lista de cines</a></div>

            <?php require_once(VIEWS_PATH."alert.php"); ?>
            <img src="<?php echo IMG_PATH."cinema.png" ?>" width="140" height="140" class="rounded-circle z-depth-0" alt="avatar image">
            <h3 class="mt-2"><?php echo $cine->getNombre(); ?></h3>
            
            <!-- Modificar cine -->
            <a href="<?php echo FRONT_ROOT ?>Cine/ShowEditView/<?php echo $cine->getId();?>" class="btn btn-warning btn-md mt-2 shadow-sm" role="button">Modificar</a>
            
            <!-- Eliminar cuenta -->
            <a onclick = "if(borrarCine('<?php echo $cine->getNombre(); ?>')) href='<?php echo FRONT_ROOT ?>Cine/eliminarCine/<?php echo $cine->getId(); ?>' ;" class="btn btn-danger btn-md mt-2 shadow-sm" role="button">Eliminar</a>

            <ul class="list-group mt-4">
                <li class="list-group-item">Direccion: <?php echo $cine->getDireccion(); ?></li>
                <li class="list-group-item">Capacidad: <?php echo $cine->getCapacidad(); ?></li>
                <li class="list-group-item">Precio: <?php echo $cine->getPrecio(); ?></li>
            </ul>
        </div>
        <div class="col-md-8 bg-light rounded p-4 shadow">
            <tr><h4 class="border-bottom border-gray pb-2 mb-0">Lista de funciones</h4></tr>
            <table class="table table-striped">
                <thead>                    
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pelicula</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Entradas</th>
                    <th scope="col" style="text-align:right">
                        <a class="btn btn-info shadow-sm" href="<?php echo FRONT_ROOT ?>Funcion/ShowAddView/<?php echo $cine->getId(); ?>">Agregar función</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php require_once(VIEWS_PATH."funcion/funcion-list.php"); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>