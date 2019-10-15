<a class="navbar-brand" href="<?php echo FRONT_ROOT ?>Cine/ShowListView">
    <img src="<?php echo IMG_PATH ?>logoMoviePass.png" width="60" height="60" alt="movie Pass logo">
</a>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <a class="nav-link text-warning" href="<?php echo FRONT_ROOT ?>Cine/ShowListView"></a>
</div>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <a class="nav-link text-warning" href="<?php echo FRONT_ROOT ?>Usuario/ShowProfileView">
        <?php echo $_SESSION["loggedUser"]->getNombre() . " " . $_SESSION["loggedUser"]->getApellido(); ?></a>
</div>

<div class="btn-group dropleft mr-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-cog"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Usuario/ShowProfileView">Perfil</a>
        <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Cine/ShowListView">Ver cines</a>
        <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Pelicula/ShowMovies">Ver peliculas</a>
        <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Usuario/ShowListView">Dar de baja Usuario</a>
        <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Usuario/ShowAdminRegisterView">Dar de alta administrador</a>
        <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Usuario/bajaAdmin">Dar de baja administrador</a>
    </div>
</div>

<a class="btn btn-success" href="<?php echo FRONT_ROOT ?>Usuario/Logout" role="button">
    <i class="fas fa-sign-out-alt"></i>Log Out
</a>