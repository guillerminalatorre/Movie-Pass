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
                                <h3 class="large text-uppercase text-center counter-count"><?php echo $estadistica['vendidas']; ?></h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-12 py-2">
                            <div class="bg-warning rounded shadow py-3 px-4 text-uppercase">
                                <h6>Remanente</h6>
                                <h3 class="large text-uppercase text-center counter-count"><?php echo $estadistica['remanente']; ?></h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-12 py-2">
                            <div class="bg-info rounded shadow py-3 px-4 text-uppercase">
                                <h6>Capacidad Total</h6>
                                <h3 class="large text-uppercase text-center counter-count"><?php echo $estadistica['capacidad']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-2">Contabilidad</h5>
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 py-2">
                            <div class="bg-success rounded shadow py-3 px-4 text-uppercase">
                                <h6>Recaudacion</h6>
                                <h3 class="large text-uppercase text-center counter-count-money"><?php echo $estadistica['recaudacion']; ?></h3>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-sm-12 py-2">
                            <div class="bg-danger rounded shadow py-3 px-4 text-uppercase">
                                <h6>Pérdida</h6>
                                <h3 class="large text-uppercase text-center counter-count-money"><?php echo $estadistica['perdida']; ?></h3>
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