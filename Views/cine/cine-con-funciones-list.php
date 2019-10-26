<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow-sm">
<a class="btn btn-secondary" href="" role="button">Volver</a>
    <?php require_once(VIEWS_PATH."alert.php"); ?>

        <h4 class="border-bottom border-gray pb-2 mb-0 text-white">Funciones disponibles de <?php echo $pelicula->getTitulo();?></h4>

        <?php foreach ($cineList as $cine) { ?>

            <h2 class="col-md-6 pb-2 text-light"><?php echo $cine->getNombre();?></h2>

            <table class="table table-sm table-dark">
                <thead class="table-active">       
                    <tr>
                        <th scope="col" style="text-align:center">Fecha</th>
                        <th scope="col" style="text-align:center">Hora</th>
                    </tr>
                </thead>
            </table>

            <?php require_once(VIEWS_PATH."funcion-disponible-list.php"); ?>

        <?php } ?>
   
</div>