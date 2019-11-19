<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="row">
        <div class="col-md-10 col-lg-3 offset-md-1 bg-light rounded p-4 text-center my-4 shadow">
            <!-- Volver a lista cines -->
            <div><a class="btn btn-secondary mb-4 shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Ver lista de cines</a></div>

            <?php require_once(VIEWS_PATH."alert.php"); ?>
            <img src="<?php echo FRONT_ROOT.IMG_PATH."cinema.png" ?>" width="140" height="140" class="rounded-circle z-depth-0" alt="cinema image">
            <h3 class="mt-2"><?php echo $cine->getNombre(); ?></h3>
            
            <!-- Modificar cine -->
            <a href="<?php echo FRONT_ROOT ?>Cine/ShowEditView/<?php echo $cine->getId();?>" class="btn btn-warning btn-md mt-2 shadow-sm" role="button">Modificar</a>
            
            <!-- Eliminar cuenta -->
            <a onclick = "if(borrarCine('<?php echo $cine->getNombre(); ?>')) href='<?php echo FRONT_ROOT ?>Cine/Remove/<?php echo $cine->getId(); ?>' ;" class="btn btn-danger btn-md mt-2 shadow-sm" role="button">Eliminar</a>

            <ul class="list-group mt-4">
                <li class="list-group-item">Direccion: <?php echo $cine->getDireccion(); ?></li>
                <li class="list-group-item">Salas: <?php echo count($salaList); ?></li>
            </ul>
        </div>

        <div class="col-md-10 col-lg-6 offset-md-1">
            <div class="container-fluid bg-light rounded p-4 my-4 shadow">
                <tr><h4 class="border-bottom border-gray pb-2 mb-2">Lista de salas</h4></tr>
                <table id="sortable" class="table table-striped table-responsive-sm">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col" style="text-align:right">
                            <a class="btn btn-info btn-sm shadow-sm" href="<?php echo FRONT_ROOT ?>Sala/ShowAddView/<?php echo $cine->getId(); ?>">Agregar sala</a>
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($salaList) && count($salaList) > 0) 
                        {
                            foreach ($salaList as $sala) 
                            {
                                require(VIEWS_PATH."sala/sala-list.php");
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="container-fluid bg-light rounded p-4 my-4 shadow">
                <tr><h4 class="border-bottom border-gray pb-2 mb-2">Lista de funciones</h4></tr>
                <table id="sortable2" class="table table-striped table-responsive-sm">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pelicula</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Vendido</th>
                        <th scope="col" style="text-align:right">
                            <a class="btn btn-info btn-sm shadow-sm" href="<?php echo FRONT_ROOT ?>Funcion/ShowAddView/<?php echo $cine->getId(); ?>">Agregar función</a>
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($funcionList) && count($funcionList) > 0) 
                        {
                            foreach ($funcionList as $funcion) 
                            {
                                require(VIEWS_PATH."funcion/funcion-list.php");
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() 
{
    $('#sortable').DataTable( {
    "columnDefs": [
        { "orderable": false, "targets": 4 }
    ]
    } );
    $('#sortable2').DataTable( {
    "columnDefs": [
        { "orderable": false, "targets": 6 }
    ]
    } );
} );
</script>