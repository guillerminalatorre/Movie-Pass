<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container">
    <div class="panelForm shadow">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <div class="row mb-4">        
            <div class="col-4"><a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $idCine; ?>" role="button">Volver a ficha</a></div>
            <div class="col-8"><h2>Datos de la funcion: </h2></div>
        </div>
        <form action="<?php echo FRONT_ROOT ?>Funcion/Add/<?php echo $idCine ?>" method="POST">
            <div class="row">
                <div class="form-group col">
                    <label for="idCine">Cine:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="idCine" readonly="readonly" value="<?php echo $idCine?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="idPelicula">Pelicula:</label>
                </div>
                <div class="col-9">
                    <select name="idPelicula" class="form-control" required>
                        <option value="0" selected>Elegir pelicula</option>
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
                <div class="col-9">
                    <input type="date" class="form-control" name="fecha" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d") ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="hora">Hora:</label>
                </div>
                <div class="col-9">
                    <input type="time" class="form-control" name="hora" value="<?php echo date("H:i"); ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm"><i class="fa fa-plus-circle"></i> Agregar Funcion</button>
                </div>
            </div>
        </form>
    </div>
</div>