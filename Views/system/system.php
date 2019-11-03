<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid">
    <div class="col-10 offset-1 bg-dark rounded pl-5 pr-5 shadow">
        <div class="row">
            <!-- For demo purpose -->
            <div class="container py-5">
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
                    <div class="col-xl-3 col-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Usuarios</h5><h3 class="large text-uppercase"><?php echo $usuarioCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Usuario/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de usuarios</a>
                        </div>
                    </div><!-- End -->

                    <!-- Team item -->
                    <div class="col-xl-3 col-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Peliculas</h5><h3 class="large text-uppercase"><?php echo $peliculaCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Pelicula/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de peliculas</a>
                            <h5 class="mt-4 mb-0">Obtener de API</h5>
                            <a href="<?php echo FRONT_ROOT ?>Pelicula/ShowApiMovies" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Peliculas</a>
                            <a href="<?php echo FRONT_ROOT ?>Genero/getGenresFromApi" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Generos</a>
                        </div>
                    </div><!-- End -->

                    <!-- Team item -->
                    <div class="col-xl-3 col-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Cines</h5><h3 class="large text-uppercase"><?php echo $cineCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Cine/ShowListView" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de cines</a>
                        </div>
                    </div><!-- End -->

                    <!-- Team item -->
                    <div class="col-xl-3 col-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4">
                            <h5 class="mb-0">Funciones</h5><h3 class="large text-uppercase"><?php echo $funcionCount; ?></h3>
                            <a href="<?php echo FRONT_ROOT ?>Funcion/ShowFuncionesPelicula" class="btn btn-info btn-md mt-2 shadow-sm" role="button">Lista de funciones</a>
                        </div>
                    </div><!-- End -->
                </div>
            </div>
        </div>
    </div>
</div>