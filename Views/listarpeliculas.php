<?php

if (isset($_SESSION["loggedUser"])) {

  if ($_SESSION["loggedUser"]->getId_Rol() === 1) {

    require_once "user-navbar.php";
  } else
    header("Location: ../Cine/ShowListView");
} else {
  require_once 'anon-navbar.php';
}

/*El último header es para reestringir entradas de Admins*/

?>

<div class="container">
  <div class="row flex-column-reverse flex-md-row">
    <?php


    foreach ($peliculaList as $values) {
      require(VIEWS_PATH . "moviecard.php");
    }
    ?>
  </div>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Anterior</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Siguiente</a>
    </li>
  </ul>
</nav>