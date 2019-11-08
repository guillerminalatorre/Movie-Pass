<?php require_once(VIEWS_PATH . "navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-white rounded shadow p-md-4 p-lg-4 p-xl-4">
        <?php require_once(VIEWS_PATH . "alert.php"); ?>
        <div class="row">
            <div class="col-4"><a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $idCine; ?>" role="button">Volver a ficha</a></div>
        </div>
        <h2 class="text-center py-4">Agregar funcion: </h2>
        <form action="<?php echo FRONT_ROOT ?>Funcion/Add/<?php echo $idCine; ?>" method="POST">
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
                    <label for="idSala">Sala:</label>
                </div>
                <div class="col-8">
                    <select name="idSala" class="form-control" required>
                        <option value="" selected>Elegir sala</option>
                        <?php foreach ($salaList as $salaValue) { ?>
                            <option value="<?php echo $salaValue->getId(); ?>"> <?php echo $salaValue->getNombre(); ?> (Capacidad: <?php echo $salaValue->getCapacidad(); ?>)</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="idPelicula">Pelicula:</label>
                </div>
                <div class="col-8">
                    <select name="idPelicula" class="form-control" required>
                        <option value="" selected>Elegir pelicula</option>
                        <?php foreach ($peliculaList as $peliculaValue) { ?>
                            <option value="<?php echo $peliculaValue->getId(); ?>"> <?php echo $peliculaValue->getTitulo(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="fecha">Fecha:</label>
                </div>
                <div class="col-8">
                    <input type="date" class="form-control" name="fecha" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d") ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="hora">Hora:</label>
                </div>
                <div class="col-8">
                    <?php $timePlus1Hour = date(("H:i"), strtotime('+1 hour')); ?>
                    <input type="time" class="form-control" name="hora" value="<?php echo date("H:i"); ?>" min="<?php echo $timePlus1Hour; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm"><i class="fa fa-plus-circle"></i> Agregar Funcion</button>
        </form>
    </div>
</div>