<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow-sm">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <h4 class="border-bottom border-gray pb-2 mb-0 text-white">Selecciona un cine:</h4>

    <?php foreach ($cineList as $cine) { ?>
            <a class="btn btn-info btn-block mt-2" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $cine->getNombre();?>"><?php echo $cine->getNombre();?></button>
    <?php } ?>

    <a class="btn btn-primary btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fa fa-plus-circle"></i> Agregar cine</a>
</div>