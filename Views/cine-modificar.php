<body>
<div class="container container-fluid mt-4">
    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaCine/<?php echo $cine->getNombre();?>" role="button">Volver a la ficha del cine</a>
    <br>
    <form action="<?php echo FRONT_ROOT ?>Cine/actualizarUnCine" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="nombre" value="<?php echo $cine->getNombre();?>" readonly="readonly">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" class="form-control" name="direccion" value="<?php echo $cine->getDireccion();?>" required>
            <label for="capacidad">Capacidad</label>
            <input type="number" id="capacidad" class="form-control" name="capacidad" value="<?php echo $cine->getCapacidad();?>" required>
            <label for="precio">Precio</label>
            <input type="number" id="precio" class="form-control" name="precio" value="<?php echo $cine->getPrecio();?>" required>
        </div>
        <div class="form-group" style="text-align:right">
           <button class="btn btn-info" type="submit">Confirmar</button>
        </div>
    </form>
</div>
</body>
