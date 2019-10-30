<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <h2 class="col-md-6 pb-2 text-light">Lista de Peliculas de la API</h2>
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
            
                <td><button class="btn btn-success shadow-sm" name="addToDatabase" data-movie="<?php echo $pelicula->getIdTMDB();?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar a la DB</button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Pelicula/ShowAddView" role="button"><i class="fa fa-plus-circle"></i> Agregar pelicula</a> -->
</div>

<script>
$("[name='addToDatabase']").click(function(){
  var movie = $(this).data("movie");
    var button= $(this);
   $.get("<?php echo FRONT_ROOT ?>Pelicula/AddToDatabase/"+movie, function(data){
        button.fadeOut();
       console.log(data);
       
       });
});

</script>