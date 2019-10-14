<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <a class="navbar-brand" href="#">
    <img src="<?php echo IMG_PATH ?>logoMoviePass.png" width="60" height="60" alt="movie Pass logo">
  </a>

<?php
  if (isset($_SESSION["loggedUser"]))
  {
    if ($_SESSION["loggedUser"]->getId_Rol() === 1)
    {
      require_once "navbar-user.php";
    }
    else if ($_SESSION["loggedUser"]->getId_Rol() === 2)
    {
      require_once "navbar-admin.php";
    }
    else if ($_SESSION["loggedUser"]->getId_Rol() === 3)
    {
      require_once "navbar-main-admin.php";
    }
  }
  else
  {
    require_once "navbar-anon.php";
  }
?>

</nav>