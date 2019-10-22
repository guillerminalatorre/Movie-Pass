<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid mt-4">
    <div class="panelForm">
        <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <form action="<?php echo FRONT_ROOT ?>Cine/Add" method="POST">
            <h2 class="text-left">Ingresa datos del cine: </h2>
            <br>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="nombre">Nombre:</label>
                </div>
                <div>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="direccion">Direccion:</label>
                </div>
                <div>
                    <input type="text" class="form-control" name="direccion" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="capacidad">Capacidad:</label>
                </div>
                <div>
                    <input type="text" class="form-control" name="capacidad" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="precio">Precio: $</label>
                </div>
                <div>
                    <input type="number" class="form-control" name="precio" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-plus-circle"></i> Agregar cine</button>
                </div>
        </form>
    </div>
</div>