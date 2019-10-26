<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-secondary rounded mt-4 my-3 p-3 shadow-sm">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <a class="btn btn-warning mb-4" href="<?php echo FRONT_ROOT ?>Home" role="button">Volver a cartelera</a>
    <h2 class="border-bottom border-gray pb-2 mb-0 text-white">Funciones disponibles de <?php echo $pelicula->getTitulo(); ?></h2>

        <?php foreach ($cineList as $cine) { ?>
            <div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow-sm">
                <h2 class="col-md-6 pb-2 text-light"><?php echo $cine->getNombre();?></h2>
                <h5 class="col-md-6 pb-2 text-light"><?php echo $cine->getDireccion();?></h5>

                <table class="table table-dark table-striped text-light align-center">
                    <thead class="table-active">       
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Disponibles</th>
                            <th scope="col" style="text-align:right">Efectuar compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $funcionList = $this->filterByCine($funciones,$cine->getId());
                        require(VIEWS_PATH."funcion/funcion-disponible-list.php"); 
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        
</div>