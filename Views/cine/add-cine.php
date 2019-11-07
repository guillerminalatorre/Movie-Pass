<?php require_once(VIEWS_PATH . "navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-white rounded shadow p-md-4 p-lg-4 p-xl-4">
        <a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
        <?php require_once(VIEWS_PATH . "alert.php"); ?>
        <form action="<?php echo FRONT_ROOT ?>Cine/Add" method="POST">
            <h2 class="text-center py-4">Ingresa datos del cine: </h2>
            <div class="row">
                <div class="form-group col text-right">
                    <label for="nombre">Nombre:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col text-right">
                    <label for="direccion">Direccion:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="direccion" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col text-right">
                    <label for="capacidad">Capacidad:</label>
                </div>
                <div class="col-8">
                    <input type="number" class="form-control" name="capacidad" min="1" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col text-right">
                    <label for="precio">Precio: $</label>
                </div>
                <div class="col-8">
                    <input type="number" class="form-control" name="precio" min="1" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm"><i class="fa fa-plus-circle"></i> Agregar cine</button>
        </form>
    </div>
</div>