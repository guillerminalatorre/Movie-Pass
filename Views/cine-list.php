<div class="container container-fluid mt-4">
    <h2>Selecciona un cine para operar: </h2>
    <?php foreach ($cineList as $cine) { ?>
            <button type="button" class="btn btn-info btn-block" href="ficha-cine.php" value = "<?php $cine->getId();?>">  <?php echo $cine->getNombre();?></button>
        <hr>
    <?php } ?>

    <a class="btn btn-success btn-block" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fas fa-plus-circle"></i> Agregar cine</a>
</div>