<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <h2 class="col-md-6 pb-2 text-light">Lista de entradas</h2>
    <table class="table table-striped text-light align-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>TMDB</th>
                <th>Duracion</th>
                <th>Popularidad</th>
                <th>Funciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entradaList as $entrada) { ?>
            <tr>
                <td><?php echo $entrada->getId(); ?></td>
                <td><a href="#modal<?php echo $entrada->getId();?>" class="view text-light" class="view" title="" data-toggle="modal" data-original-title="View Details"><img src="<?php echo $entrada->getPoster(); ?>"  height="35" width="35" class="rounded-circle z-depth-0 mr-2" alt="entrada image">
                <b><?php echo $entrada->getTitulo(); ?></b></a></td>
                <td><?php echo $entrada->getIdTMDB(); ?></td>
                <td><?php echo $entrada->getDuracion(); ?></td>
                <td><?php echo $entrada->getPopularidad(); ?></td>
                <td><?php echo count($this->funcionDAO->getByPelicula($entrada)); ?></td>
                <td><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>