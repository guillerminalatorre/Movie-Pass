<?php
require_once(VIEWS_PATH."checklogin.php");
require_once(VIEWS_PATH."navbar.php");
?>

<div class="container black">
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