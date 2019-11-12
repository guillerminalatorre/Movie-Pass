<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark-transparent rounded shadow p-sm-1 p-md-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <div class="p-2">
            <form action="<?php echo FRONT_ROOT ?>Estadistica" method="POST" id="estadisticaForm">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Pelicula</h5>
                            <select name="idPelicula" id="idPelicula" class="form-control" onchange="document.getElementById('estadisticaForm').submit();">
                                <option value="" <?php if($idPelicula != null) { ?>selected<?php } ?>>Elegir pelicula</option>
                                <?php foreach ($peliculaList as $peliculaValue) { ?>
                                    <option value="<?php echo $peliculaValue->getId(); ?>" <?php if($idPelicula != null && $idPelicula == $peliculaValue->getId()) { ?>selected<?php } ?>> <?php echo $peliculaValue->getTitulo(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Cine</h5>
                            <select name="idCine" id="idCine" class="form-control" onchange="document.getElementById('estadisticaForm').submit();">
                                <option value="" <?php if($idCine == null) { ?>selected<?php } ?>>Elegir cine</option>
                                <?php foreach ($cineList as $cineValue) { ?>
                                <option value="<?php echo $cineValue->getId(); ?>" <?php if($idCine != null && $idCine == $cineValue->getId()) { ?>selected<?php } ?>> <?php echo $cineValue->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Funcion
                            <!-- <a class="text-info float-right" onclick="document.getElementById('estadisticaForm').submit();" role="button"><i class="fa fa-refresh"></i></a> -->
                            </h5>
                            
                            <?php if(!count($funcionList)) { ?>
                            <input type="text" name="idFuncion" placeholder="No existen funciones."  class="form-control" value="" readonly>
                            <?php } else { ?>
                            <select name="idFuncion" id="idFuncion" class="form-control" onchange="document.getElementById('estadisticaForm').submit();">
                                <option value="" <?php if($idFuncion == null) { ?>selected<?php } ?>>Elegir funcion</option>
                                <?php foreach ($funcionList as $funcionValue) { ?>
                                    <?php $pelicula->setId($funcionValue->getIdPelicula());
                                    $pelicula = $this->peliculaDAO->getPelicula($pelicula); 
                                    $cine->setId($funcionValue->getIdCine());
                                    $cine = $this->cineDAO->getCine($cine);
                                    ?>
                                    <option value="<?php echo $funcionValue->getId(); ?>" <?php if($idFuncion != null && $idFuncion == $funcionValue->getId()) { ?>selected<?php } ?>> <?php echo $pelicula->getTitulo()." (".$cine->getNombre()." ".$funcionValue->getFechaHora().")"; ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="btn-group input-group col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
                        <input type="date" name="fechaInicio" placeholder="Fecha inicio:" value="<?php if($fechaInicio != null) { echo date("Y-m-d",$timeInicio); } ?>" class="form-control" onchange="document.getElementById('estadisticaForm').submit();">
                    </div>
                    <div class="btn-group input-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <input type="date" name="fechaFin" placeholder="Fecha fin:" value="<?php if($fechaFin != null) echo date("Y-m-d",$timeFin); ?>" class="form-control" onchange="document.getElementById('estadisticaForm').submit();">
                    </div>
                    <!-- <div class="btn-group col-12">
                        <button type="submit" class="btn btn-info shadow-sm">Buscar</button>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid mb-4">
    <div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark-transparent rounded shadow p-sm-2 p-md-3">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-sm-12 py-2">
                <div class="bg-light rounded shadow-sm py-3 px-4">
                    <h4 class="mb-2">Filtros utilizados</h4>
                    <ul class="list-group mt-4">
                        <li class="list-group-item">Pelicula: 
                        <?php if($idPelicula != null) echo $pelicula->getTitulo();
                        else echo "No aplicado"; ?>
                        </li>
                        <li class="list-group-item">Cine:
                        <?php if($idCine != null) echo $cine->getNombre();
                        else echo "No aplicado"; ?>
                        </li>
                        <li class="list-group-item">Funcion:
                        <?php if($idFuncion != null) {
                            $pelicula->setId($funcion->getIdPelicula());
                            $pelicula = $this->peliculaDAO->getPelicula($pelicula); 
                            $cine->setId($funcion->getIdCine());
                            $cine = $this->cineDAO->getCine($cine);
                            echo $pelicula->getTitulo()." (".$cine->getNombre().") ".$funcion->getFechaHora();
                        } else echo "No aplicado"; ?>
                        </li>
                        <li class="list-group-item">Fecha inicio: 
                        <?php if($fechaInicio != null) echo $fechaInicio; 
                        else echo "No aplicado"; ?>
                        <li class="list-group-item">Fecha fin: 
                        <?php if($fechaFin != null) echo $fechaFin; 
                        else echo "No aplicado"; ?>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-8 col-lg-6 col-sm-12 py-2">
                <div class="bg-light rounded shadow-sm py-3 px-4">
                    <h5 class="mb-2">Estadisticas (<?php echo $count; ?> funciones)</h5>
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-sm-12 py-2">
                            <div class="bg-success rounded shadow py-3 px-4 text-uppercase">
                                <h6>Vendido</h6>
                                <h3 class="large text-uppercase text-center counter-count"><?php echo $vendidas; ?></h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-12 py-2">
                            <div class="bg-warning rounded shadow py-3 px-4 text-uppercase">
                                <h6>Remanente</h6>
                                <h3 class="large text-uppercase text-center counter-count"><?php echo $remanente; ?></h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-12 py-2">
                            <div class="bg-info rounded shadow py-3 px-4 text-uppercase">
                                <h6>Capacidad Total</h6>
                                <h3 class="large text-uppercase text-center counter-count"><?php echo $capacidad; ?></h3>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-2">Contabilidad</h5>
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 py-2">
                            <div class="bg-success rounded shadow py-3 px-4 text-uppercase">
                                <h6>Recaudacion</h6>
                                <h3 class="large text-uppercase text-center counter-count-money"><?php echo $recaudacion; ?></h3>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-sm-12 py-2">
                            <div class="bg-danger rounded shadow py-3 px-4 text-uppercase">
                                <h6>Pérdida</h6>
                                <h3 class="large text-uppercase text-center counter-count-money"><?php echo $perdida; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
input[type="date"]:before {
    content: attr(placeholder) !important;
    color: #aaa;
    margin-right: 0.5em;
  }
  input[type="date"]:focus:before,
  input[type="date"]:valid:before {
    content: "";
  }
</style>

<script>
    $('.counter-count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

$('.counter-count-money').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1500,
        easing: 'swing',
        step: function (now) {
            $(this).text("$ " + Math.ceil(now));
        }
    });
});
</script>