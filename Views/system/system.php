<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid">
    <div class="col-10 offset-1 bg-dark-transparent rounded pl-5 pr-5 shadow">
        <?php if(isset($_SESSION['flash']) && count($_SESSION['flash']) > 0) { ?>
            <div class="row">
                <div class="col-12 pt-3">
                    <?php require_once(VIEWS_PATH."alert.php"); ?>
                </div>
            </div>            
        <?php } ?>
        <div class="row">
            <!-- For demo purpose -->
            <div class="container py-4">
                <div class="row text-center text-white">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="display-4">Administración Moviepass</h1>
                        <p class="lead mb-0">A continuación esta el panel de control de administrador con todos los comandos exclusivos para obtener los datos de la API y de la base de datos. </p>
                    </div>
                </div>
            </div><!-- End -->

            <div class="container">
                <div class="row text-center">

                    <!-- Team item -->
                    <div class="col-xl-3 col-lg-6 col-sm-12 mb-5">
                        <div class="bg-light rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Usuarios</h5><h3 class="large text-uppercase counter-count"><?php echo $usuarioCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Usuario/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de usuarios</a>
                        </div>
                    </div><!-- End -->

                    <!-- Team item -->
                    <div class="col-xl-3 col-lg-6 col-sm-12 mb-5">
                        <div class="bg-light rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Peliculas</h5><h3 class="large text-uppercase counter-count"><?php echo $peliculaCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Pelicula/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de peliculas</a>
                            <h5 class="mt-4 mb-0">Obtener de API</h5>
                            <a href="<?php echo FRONT_ROOT ?>Pelicula/ShowApiMovies" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Peliculas</a>
                            <a href="<?php echo FRONT_ROOT ?>Genero/getGenresFromApi" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Generos</a>
                        </div>
                    </div><!-- End -->

                    <!-- Team item -->
                    <div class="col-xl-3 col-lg-6 col-sm-12 mb-5">
                        <div class="bg-light rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Cines</h5><h3 class="large text-uppercase counter-count"><?php echo $cineCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Cine/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de cines</a>
                        </div>
                    </div><!-- End -->

                    <!-- Team item -->
                    <div class="col-xl-3 col-lg-6 col-sm-12 mb-5">
                        <div class="bg-light rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Funciones</h5><h4 class="large text-uppercase counter-count"><?php echo $funcionCount; ?></h4>
                            <a href="<?php echo FRONT_ROOT ?>Funcion/ShowFuncionesPelicula" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de funciones</a>
                            <h5 class="mt-4 mb-0">Entradas</h5><h4 class="large text-uppercase counter-count"><?php echo $entradaCount; ?></h4>
                            <a href="<?php echo FRONT_ROOT ?>Entrada/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de entradas</a>
                        </div>
                    </div><!-- End -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.counter-count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>