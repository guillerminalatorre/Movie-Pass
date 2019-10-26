<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container bg-dark rounded">
  <?php require_once(VIEWS_PATH."alert.php"); ?>
  <div class="row flex-column-reverse flex-md-row">
    <?php
    if(!empty($peliculaList)){
      foreach ($peliculaList as $values) {
        require("moviecard.php");
      }
    }
    ?>
  </div>
</div>