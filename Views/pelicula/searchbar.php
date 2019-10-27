<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container bg-dark rounded pt-2">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <div class="jumbotron bg-dark border-0 text-white">
        <form action="<?php echo FRONT_ROOT ?>Funcion/FilterFunctions/" method="POST">
            <div class="col-md-6 border-bottom pb-2 mb-n4">
                <h3 class="">Elije una categoria y/o una fecha: </h3>
            </div>
            <br>
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group col-md-6">
                    <select name="genreId" class="form-control ">
                        <option disabled selected>Elije una categoria...</option>
                        <?php
                        foreach ($generoList as $generoValue) {
                            ?>
                            <option value="<?php echo $generoValue->getId(); ?>"> <?php echo $generoValue->getNombre(); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group col-md-3">
                    <input type="date" name="chosenDate" min="<?php echo date("Y-m-d")?>" class="form-control">
                </div>
                <div class="btn-group col-md-3">
                    <button type="submit" class="btn btn-warning">Buscar</button>
                </div>
            </div>
        </form>
    </div>
</div>