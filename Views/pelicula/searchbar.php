<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark-transparent rounded shadow p-sm-2 p-md-4">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <div class="text-white p-2">
            <form action="<?php echo FRONT_ROOT ?>Funcion/FilterFunctions" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                        <h3 class="border-bottom pb-2">Filtrar funciones:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="btn-group col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-2">
                        <select name="genreId" class="form-control ">
                            <option value="NULL" <?php if(!isset($genreId)) { echo "selected"; } ?>>Categorias</option>
                            <?php foreach ($generoList as $generoValue) { ?>
                                <option value="<?php echo $generoValue->getId(); ?>" <?php if(isset($genreId) && $genreId == $generoValue->getId()) { echo "selected"; } ?>> <?php echo $generoValue->getNombre(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="btn-group input-group col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-2">
                        <input type="date" name="fechaInicio" placeholder="Inicio:" min="<?php echo date("Y-m-d")?>" value="<?php if(isset($fechaInicio) && $fechaInicio != null) { echo $fechaInicio; } ?>" class="form-control">
                    </div>
                    <div class="btn-group input-group col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-2">
                        <input type="date" name="fechaFin" placeholder="Fin:" min="<?php echo date("Y-m-d")?>" value="<?php if(isset($fechaFin) && $fechaFin != null) echo $fechaFin; ?>" class="form-control">
                    </div>
                    <div class="btn-group col-xs-12 col-sm-6 col-md-12 col-lg-12 col-xl-3 mb-2">
                        <button type="submit" class="btn btn-success shadow-sm">Buscar</button>
                    </div>
                </div>
            </form>
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