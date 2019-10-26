<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow-sm">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <h2 class="col-md-6 pb-2 text-light">Lista de peliculas</h2>
    <table class="table table-striped text-light align-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>TMDB</th>
                <th>Duracion</th>
                <th>Popularidad</th>
                <th>Funciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peliculaList as $pelicula) { ?>
            <tr>
                <td><?php echo $pelicula->getId(); ?></td>
                <td><a href="" class="text-light"><img src="
                    <?php
                    $poster = $pelicula->getPoster();
                    if ($poster != NULL) 
                    {
                        echo "https://image.tmdb.org/t/p/w500" . $poster;
                    } 
                    else 
                    {
                        echo IMG_PATH . "noImage.jpg";
                    }
                    ?>
                "  height="35" width="35" class="rounded-circle z-depth-0 mr-2" alt="pelicula image">
                <b><?php echo $pelicula->getTitulo(); ?></b></a></td>
                <td><?php echo $pelicula->getIdTMDB(); ?></td>
                <td><?php echo $pelicula->getDuracion(); ?></td>
                <td><?php echo $pelicula->getPopularidad(); ?></td>
                <td><?php echo count($this->funcionDAO->getByPelicula($pelicula)); ?></td>
                <!-- <td><a href="<?php echo FRONT_ROOT ?>Pelicula/ShowFichaView/<?php echo $pelicula->getId();?>" class="view" title="" data-toggle="tooltip" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td> -->
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Pelicula/ShowAddView" role="button"><i class="fa fa-plus-circle"></i> Agregar pelicula</a> -->
</div>