<?php
require_once(VIEWS_PATH."checklogin.php");
require_once(VIEWS_PATH."navbar.php");
?>
<head>
<script languaje="javascript">
    function  verificacion {
            alert('La función se ha agregado satisfactoriamente');
    }
</script>
</head>
<body>
    <div class="container">
            <div class="loginForm">
                <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowFichaCine/<?php echo $nombre_Cine; ?>" role="button">Volver a ficha del cine</a>
                <form action="<?php echo FRONT_ROOT ?>Funcion/Add/<?php echo $nombre_Cine;?>" method="POST">
                    <h2 class="text-left">Ingresa datos de la funcion: </h2>
                    <br>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                            <label for="id">Id:</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="id" value="<?php echo $id?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                            <label for="nombreCine">NombreCine:</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="nombreCine" readonly="readonly" value="<?php echo $nombre_Cine?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                            <label for="idPelicula">Id Pelicula:</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="idPelicula" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                            <label for="fecha">Fecha:</label>
                        </div>
                        <div>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                            <label for="hora">Hora:</label>
                        </div>
                        <div>
                            <input type="time" class="form-control" name="hora"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                            <label for="cantEntradas">Cant. Entradas:</label>
                        </div>
                        <div>
                            <input type="number" class="form-control" name="cantEntradas" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm text-right">
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-plus-circle"></i> Agregar Funcion</button>
                    </div>
                </form>
            </div>
    </div>
</body>