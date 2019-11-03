<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <a class="btn btn-secondary mb-4 shadow-sm" href="<?php echo FRONT_ROOT ?>System" role="button">Volver a sistema</a>
    <h2 class="col-6 pb-2 text-light">Lista de Peliculas de la API</h2>
    <table class="table table-striped text-light align-center">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>TMDB</th>
                <th>Popularidad</th>
                <th>Fecha de estreno</th>
                <th>Agregar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peliculaList as $pelicula) { ?>
            <tr>
                <td><div class="view text-light" class="view" title="" data-toggle="modal" data-original-title="View Details"><img src="<?php echo $pelicula->getPoster(); ?>"  height="35" width="35" class="rounded-circle z-depth-0 mr-2" alt="pelicula image">
                <b><?php echo $pelicula->getTitulo(); ?></b></div></td>
                <td><?php echo $pelicula->getIdTMDB(); ?></td>
                <td><?php echo $pelicula->getPopularidad(); ?></td>
                
                <td><?php echo $pelicula->getFechaDeEstreno(); ?></td>
            
                <td>
                    <a name="addToDatabase" class="view text-primary" data-movie="<?php echo $pelicula->getIdTMDB();?>" role="button"><h4><i class="fa fa-plus-circle"></i></h4></a>
                    <div class="spinner-border spinner-border-sm" id="loading<?php echo $pelicula->getIdTMDB();?>" style="display: none;" role="status"><span class="sr-only">Loading...</span></div>
                    <a class="view text-success" id="ok<?php echo $pelicula->getIdTMDB();?>" style="display: none;" role="button"><h4><i class="fa fa-check-circle"></i></h4></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Pelicula/ShowAddView" role="button"><i class="fa fa-plus-circle"></i> Agregar pelicula</a> -->
</div>

<script>
$("[name='addToDatabase']").click(function() {
    var movie = $(this).data("movie");
    var loading = document.getElementById("loading" + movie);
    var ok = document.getElementById("ok" + movie);
    $(this).hide();
    loading.style.display = "inline-block";
    $.get("<?php echo FRONT_ROOT ?>Pelicula/AddToDatabase/"+movie, function(data) {
        loading.style.display = "none";
        ok.style.display = "inline-block";
        console.log(data);
    });
});
</script>