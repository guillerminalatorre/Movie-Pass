<?php
require_once(VIEWS_PATH."navbar.php");
?>

<div class="container bg-dark rounded">
    <div class="jumbotron bg-dark border-0 text-white">
        <form action="<?php echo FRONT_ROOT ?>Pelicula/ShowFilteredMovies" method="POST">
            <div class="col-md-6 border-bottom pb-2 mb-n4">
                <h3 class="">Elije una categoria y/o una fecha: </h3>
            </div>
            <br>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group col-md-6" role="group" aria-label="First group">
                    <select name="id" class="form-control ">
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
                <div class="input-group col-md-3" role="group" aria-label="Second group">
                    <input type="date" min="<?php echo date("Y-m-d")?>" class="form-control">
                </div>
                <div class="btn-group col-md-3" role="group" aria-label="Third group">
                    <button type="submit" class="btn btn-warning">Buscar</button>
                </div>
            </div>
        </form>
    </div>
</div>