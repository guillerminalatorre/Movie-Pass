<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-light rounded shadow p-md-4 p-lg-4 p-xl-4">
        <a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $cine->getId(); ?>" role="button">Volver a la ficha del cine</a>
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <form action="<?php echo FRONT_ROOT ?>Cine/Update" method="post">
            <input type="hidden" name="id" value="<?php echo $cine->getId(); ?>">
            <h2 class="text-center py-4">Modificar cine: </h2>
            <div class="row">
                <div class="form-group col text-right">
                    <label for="nombre">Nombre:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="nombre" value="<?php echo $cine->getNombre();?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="form-group col text-right">
                    <label for="direccion">Direccion:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="direccion" value="<?php echo $cine->getDireccion();?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm"><i class="fa fa-plus-circle"></i> Actualizar Datos</button>
        </form>
    </div>
</div>
