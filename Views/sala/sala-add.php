<?php require_once(VIEWS_PATH . "navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-white rounded shadow p-md-4 p-lg-4 p-xl-4">
        <?php require_once(VIEWS_PATH . "alert.php"); ?>
        <div class="row">
            <div class="col-4"><a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $idCine; ?>" role="button">Volver a ficha</a></div>
        </div>
        <h2 class="text-center py-4">Agregar funcion: </h2>
        <form action="<?php echo FRONT_ROOT ?>Sala/Add/<?php echo $idCine; ?>" method="POST">
            <div class="row">
                <div class="form-group col">
                    <label for="idCine">Cine:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="idCine" readonly="readonly" value="<?php echo $idCine ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="idPelicula">Nombre:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="fecha">Precio:</label>
                </div>
                <div class="col-8">
                    <input type="number" class="form-control" name="precio" value="0" min="0" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="hora">Capacidad:</label>
                </div>
                <div class="col-8">
                    <input type="number" class="form-control" name="capacidad" value="0" min="0" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm"><i class="fa fa-plus-circle"></i> Agregar Sala</button>
        </form>
    </div>
</div>