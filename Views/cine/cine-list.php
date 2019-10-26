<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow-sm">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <h2 class="col-md-6 pb-2 text-light">Lista de cines</h2>
    <table class="table table-striped text-light align-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Capacidad</th>
                <th>Precio</th>
                <th>Funciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cineList as $cine) { ?>
            <tr>
                <td><?php echo $cine->getId(); ?></td>
                <td><a href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $cine->getId();?>" class="text-light"><img src="<?php echo IMG_PATH."cinema.png" ?>" height="35" class="rounded-circle z-depth-0 mr-2" alt="cinema image"><b><?php echo $cine->getNombre(); ?></b></a></td>
                <td><?php echo $cine->getDireccion(); ?></td>
                <td><?php echo $cine->getCapacidad(); ?></td>
                <td><?php echo $cine->getPrecio(); ?></td>
                <td><?php echo count($this->funcionDAO->getByCine($cine)); ?></td>
                <td><a href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $cine->getId();?>" class="view" title="" data-toggle="tooltip" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fa fa-plus-circle"></i> Agregar cine</a>
</div>