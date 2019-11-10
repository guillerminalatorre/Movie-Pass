<nav class="navbar navbar-expand-xl navbar-dark bg-dark-transparent mb-4 shadow">

  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
  </button>

  <?php require_once("navbar/navbar-icon.php"); ?>  

  <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-2">
      <li class="nav-item mx-xl-2">
        <a class="nav-link text-light" href="<?php echo FRONT_ROOT ?>Home">Inicio</a>
      </li>

      <?php
      if (isset($_SESSION["loggedUser"])) {
        if ($_SESSION["loggedUser"]->getId_Rol() == 1) {
          require_once("navbar/navbar-user.php");
        } else if ($_SESSION["loggedUser"]->getId_Rol() == 2) {
          require_once("navbar/navbar-admin.php");
        } else if ($_SESSION["loggedUser"]->getId_Rol() == 3) {
          require_once("navbar/navbar-main-admin.php");
        }
  require_once("navbar/navbar-search.php");
  require_once("navbar/navbar-dropdown.php");
} 
else 
{
  require_once("navbar/navbar-anon.php");
}
?>

</nav>