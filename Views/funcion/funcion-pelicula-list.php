<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-secondary rounded shadow p-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <a class="btn btn-warning mb-4 shadow-sm" href="<?php echo FRONT_ROOT ?>Home" role="button">Volver a cartelera</a>
        <h2 class="col-12 border-bottom border-gray pb-2 mb-0 text-white">Funciones disponibles <?php if($idPelicula != null) { ?> de <?php echo $pelicula->getTitulo(); ?><?php } ?></h2>
            
            <?php foreach ($cineList as $funcionCine) 
            { 
                $cine->setId($funcionCine->getIdCine());
                $cine = $this->cineDAO->getCine($cine);
                ?>
                
                <div class="container-fluid my-4">
                    <div class="col-12 bg-dark rounded shadow p-2">
                        <h2 class="col-6 pb-2 text-light"><?php echo $cine->getNombre();?></h2>
                        <h5 class="col-6 pb-2 text-light"><?php echo $cine->getDireccion();?></h5>

                        <table class="table table-dark table-striped table-responsive-md text-light align-center">
                            <thead class="table-active">       
                                <tr>
                                    <th scope="col">#</th>
                                    <?php if($idPelicula == null) { ?><th scope="col">Pelicula</th><?php } ?>
                                    <th scope="col">Sala</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Ent. Vendidas</th>
                                    <?php if($idPelicula != null && $esAdmin == false) { ?><th scope="col" style="text-align:right">Efectuar compra</th>
                                    <?php } else { ?><th scope="col" style="text-align:right">Accion</th><?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($idPelicula != null) 
                                {
                                    $funcionList = $this->funcionDAO->getByCinePelicula($cine,$pelicula);
                                } 
                                else 
                                {
                                    $funcionList = $this->funcionDAO->getByCine($cine);
                                }
                                if(isset($funcionList) && count($funcionList) > 0) 
                                { 
                                    foreach ($funcionList as $funcion) 
                                    {
                                        require(VIEWS_PATH."funcion/funcion-list.php");
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>        
    </div>
</div>