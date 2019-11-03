<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-10 offset-1 bg-dark rounded shadow p-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <div class="text-white p-2">
            <form action="<?php echo FRONT_ROOT ?>Funcion/FilterFunctions" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                        <h3 class="border-bottom pb-2">Filtrar por categoria/fecha:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="btn-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                        <select name="genreId" class="form-control ">
                            <option value="none" selected>Elije una categoria...</option>
                            <?php
                            foreach ($generoList as $generoValue) {
                                ?>
                                <option value="<?php echo $generoValue->getId(); ?>"> <?php echo $generoValue->getNombre(); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="btn-group input-group col-xs-12 col-sm-6 col-md-6 col-lg-3 mb-2">
                        <input type="date" name="chosenDate" min="<?php echo date("Y-m-d")?>" class="form-control">
                    </div>
                    <div class="btn-group col-xs-12 col-sm-6 col-md-6 col-lg-3 mb-2">
                        <button type="submit" class="btn btn-success shadow-sm">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>