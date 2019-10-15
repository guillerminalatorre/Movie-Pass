<?php

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

<?php 
if (isset($_GET['page'])) {
  $pageValue = $_GET['page'];
} else {
  $pageValue = 1;
}
?>

<nav class="mt-5" aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
    <a class="page-link" href="
      <?php if($pageValue>1){
        echo "?page=".($pageValue-1);
      }
      else{ echo "#";
      } ?> ">Anterior</a>
    </li>
    <?php
      foreach(range(1, $totalPages) as $page){
        ?>
        <li class="page-item"><a class="page-link" href="
        <?php echo "?page=" . $page ?>"> 
        <?php echo $page ?> </a>';    
        <?php
      }
      ?>
    <li class="page-item"><a class="page-link" href="<?php 
      if($pageValue<$totalPages){
        echo "?page=".($pageValue +1); 
      }else
      {
        echo "#";
      }?>  
    
    ">Siguiente</a>
    </li>
  </ul>
</nav>