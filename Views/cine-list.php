<?php
require_once(VIEWS_PATH . "check-login-admin.php");
require_once(VIEWS_PATH."navbar.php");
?>

<div class="container container-fluid mt-4">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h4 class="border-bottom border-gray pb-2 mb-0">Selecciona un cine:</h4>

        <?php foreach ($cineList as $cine) { ?>
                <a class="btn btn-success btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaCine/<?php echo $cine->getNombre();?>"><?php echo $cine->getNombre();?></button>
        <?php } ?>

        <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fas fa-plus-circle"></i> Agregar cine</a>
    </div>
</div>