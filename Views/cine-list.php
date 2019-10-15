<?php
require_once(VIEWS_PATH . "check-login-admin.php");
require_once(VIEWS_PATH."navbar.php");
?>

<div class="container container-fluid mt-4">
<div class="p-3 mb-2 bg-dark text-white">
    <h2 class="display-4" >Selecciona un cine para operar: </h2>
    </div>

    <?php foreach ($cineList as $cine) { ?>
            <a class="btn btn-success btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaCine/<?php echo $cine->getNombre();?>"><?php echo $cine->getNombre();?></button>
    <?php } ?>

    <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fas fa-plus-circle"></i> Agregar cine</a>
</div>