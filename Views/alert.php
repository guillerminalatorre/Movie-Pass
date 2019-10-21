<?php 
if(isset($_SESSION['flash']) && $_SESSION['flash'] != null) { 
  foreach($_SESSION['flash'] as $message) {
?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
  <?php echo $message; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
 } 
}
?>