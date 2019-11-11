<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark-transparent rounded shadow p-sm-1 p-md-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <div class="p-2">
            <form action="<?php echo FRONT_ROOT ?>Estadistica/FilterFunctions" method="POST">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Pelicula</h5>
                            <select name="idPelicula" id="idPelicula" class="form-control" onchange="funciones()">
                                <option value="" selected>Elegir pelicula</option>
                                <?php foreach ($peliculaList as $peliculaValue) { ?>
                                    <option value="<?php echo $peliculaValue->getId(); ?>"> <?php echo $peliculaValue->getTitulo(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Cine</h5>
                            <select name="idCine" id="idCine" class="form-control" onchange="funciones()">
                                <option value="" selected>Elegir cine</option>
                                <?php foreach ($cineList as $cineValue) { ?>
                                    <option value="<?php echo $cineValue->getId(); ?>"> <?php echo $cineValue->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Funcion</h5>
                            <select name="idFuncion" id="idFuncion" class="form-control">
                                <option value="" selected>Elegir funcion</option>
                                <?php foreach ($funcionList as $funcionValue) { ?>
                                    <?php $pelicula->setId($funcionValue->getIdPelicula());
                                    $pelicula = $this->peliculaDAO->getPelicula($pelicula); ?>
                                    <option value="<?php echo $funcionValue->getId(); ?>"> <?php echo $pelicula->getTitulo(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="btn-group input-group col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
                        <input type="date" name="start" min="<?php echo date("Y-m-d")?>" class="form-control">
                    </div>
                    <div class="btn-group input-group col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
                        <input type="date" name="end" min="<?php echo date("Y-m-d")?>" class="form-control">
                    </div>
                    <div class="btn-group col-12">
                        <button type="submit" class="btn btn-info shadow-sm">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>