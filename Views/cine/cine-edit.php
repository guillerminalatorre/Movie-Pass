<div class="container container-fluid mt-4">
    <div class="loginForm">
        <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Home/FichaCine/<?php echo $cine->getNombre(); ?>" role="button">Volver a la ficha del cine</a>
        <br>
        <form action="<?php echo FRONT_ROOT ?>Cine/updateCine" method="post">
        <h2 class="text-left">Modificar cine: </h2>
            <br>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="nombre">Nombre:</label>
                </div>
                <div>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $cine->getNombre();?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="direccion">Direccion:</label>
                </div>
                <div>
                    <input type="text" class="form-control" name="direccion" value="<?php echo $cine->getDireccion();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="capacidad">Capacidad:</label>
                </div>
                <div>
                    <input type="number" class="form-control" name="capacidad" value="<?php echo $cine->getCapacidad();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <label for="precio">Precio:</label>
                </div>
                <div>
                    <input type="number" class="form-control" name="precio" value="<?php echo $cine->getPrecio();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm text-right">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-plus-circle"></i> Actualizar Datos</button>
                </div>
            </div>
        </form>
    </div>
</div>
