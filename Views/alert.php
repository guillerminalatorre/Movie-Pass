<?php 
if(isset($_SESSION['flash']) && count($_SESSION['flash']) > 0) { 
  foreach($_SESSION['flash'] as $data) {
?>

<div class="alert alert-<?php echo $data[1]; ?> alert-dismissible fade show" role="alert">
  <?php echo $data[0]; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
 } 
}
?>