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
                            <select name="idPelicula" id="idPelicula" class="form-control" onchange="botonCargar()">
                                <option value="" <?php if($idPelicula != null) { ?>selected<?php } ?>>Elegir pelicula</option>
                                <?php foreach ($peliculaList as $peliculaValue) { ?>
                                    <option value="<?php echo $peliculaValue->getId(); ?>"> <?php echo $peliculaValue->getTitulo(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Cine</h5>
                            <select name="idCine" id="idCine" class="form-control" onchange="botonCargar()">
                                <option value="" <?php if($idCine != null) { ?>selected<?php } ?>>Elegir cine</option>
                                <?php foreach ($cineList as $cineValue) { ?>
                                    <option value="<?php echo $cineValue->getId(); ?>"> <?php echo $cineValue->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-3">
                        <div class="bg-light rounded shadow-sm py-4 px-4">
                            <h5 class="mb-2">Funcion<a class="text-info float-right" onclick="document.getElementById('estadisticaForm').submit();" role="button"><i class="fa fa-refresh"></i></a></h5>
                            
                            <select name="idFuncion" id="idFuncion" class="form-control">
                                <option value="" <?php if($idFuncion != null) { ?>selected<?php } ?>>Elegir funcion</option>
                                <?php foreach ($funcionList as $funcionValue) { ?>
                                    <?php $pelicula->setId($funcionValue->getIdPelicula());
                                    $pelicula = $this->peliculaDAO->getPelicula($pelicula); 
                                    $cine->setId($funcionValue->getIdCine());
                                    $cine = $this->cineDAO->getCine($cine);
                                    ?>
                                    <option value="<?php echo $funcionValue->getId(); ?>"> <?php echo $pelicula->getTitulo()." (".$cine->getNombre()." ".$funcion->getFechaHora().")"; ?></option>
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
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark-transparent rounded shadow p-sm-1 p-md-2">
        <div class="col-xl-3 col-lg-6 col-sm-12 py-2">
            <div class="bg-light rounded shadow-sm py-3 px-4">
                <h5 class="mb-2">Filtros utilizados</h5>
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
                    <?php if($idFuncion != null) echo $funcion->getNombre();
                    else echo "No aplicado"; ?>
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
    </div>
</div>
<script>
function funciones() 
{
    var cine = $("#idCine :selected").val();
    var data = new FormData();
    data.append('idPelicula', $("#idPelicula :selected").val());
    data.append('idCine', $("#idCine :selected").val());
    var xhttp;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            loadData(this.responseText);
        }
    };
    
    xhttp.open("POST", "<?php echo FRONT_ROOT ?>Estadistica/ReturnFunciones", true);
    xhttp.send(data);
}

function loadData(data)
{
    var $select = $('select.idFuncion');
    $select.empty();
                        
    for (var i = 0; i < data.length; i++)
        var o = $('<option/>', { value: data[i] }).text(data[i]).prop('selected', i == 0);
        o.appendTo($select);
}
</script>