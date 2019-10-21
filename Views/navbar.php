<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  
  <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>Home/ListMovies">
    <img src="<?php echo IMG_PATH ?>logoMoviePass.png" height="40" class="d-inline-block align-center" alt="mdb logo">  MoviePass
  </a>

  <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-2">
      <li class="nav-item">
        <a class="nav-link text-light" href="<?php echo FRONT_ROOT ?>Home/ListMovies">Inicio</a>
      </li>
  
  <?php
    if (isset($_SESSION["loggedUser"]))
    {
      if ($_SESSION["loggedUser"]->getId_Rol() === 1)
      {
        require_once "navbar/navbar-user.php";
      }
      else if ($_SESSION["loggedUser"]->getId_Rol() === 2)
      {
        require_once "navbar/navbar-admin.php";
      }
      else if ($_SESSION["loggedUser"]->getId_Rol() === 3)
      {
        require_once "navbar/navbar-main-admin.php";
      }
  ?>

  </div>

  <form class="form-inline my-0 mr-5">
    <div class="md-form form-sm my-0">
      <input class="form-control form-control-sm mr-sm-2 mb-0" type="text" placeholder="Buscar pelicula" aria-label="Search">
    </div>
  </form>

  <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item avatar dropdown">
          <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["loggedUser"]->getNombre() . " " . $_SESSION["loggedUser"]->getApellido(); ?><img src="<?php echo $_SESSION["loggedUser"]->getImage() ?>" height="30" class="rounded-circle z-depth-0 ml-2" alt="avatar image">
          </a>
          <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
            <a class="dropdown-item waves-effect waves-light" href="<?php echo FRONT_ROOT ?>Home/ViewProfile/<?php echo $_SESSION["loggedUser"]->getEmail(); ?>"><i class="fas fa-user"></i> Ver perfil</a>
            <a class="dropdown-item waves-effect waves-light" href="<?php echo FRONT_ROOT ?>Home/EditProfile/<?php echo $_SESSION["loggedUser"]->getEmail(); ?>"><i class="fas fa-edit"></i> Modificar perfil</a>
            <a class="dropdown-item waves-effect waves-light" href="<?php echo FRONT_ROOT ?>Usuario/Logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
          </div>
      </li>
  </ul>

  <?php
    }
    else
    {
      require_once "navbar/navbar-anon.php";
    }
  ?>
  
</nav>