<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 movie-card">
    <div class="card movie-card-height shadow">
        <div class="card-header" >
            <img class="card-img mb-4" src="<?php echo $values->getPoster(); ?>" alt="Poster image">
        </div>
        <div class="card-body">
            <h3 class="card-title">
                <?php echo $values->getTitulo(); ?>
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-4" style="color: gold;">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <p><?php echo $values->getPopularidad() . "/10"; ?></p>
                    </div>
                    <div class="col-8 metadata">
                <!--Generos-->        
                </div>
                </div>
            </div>
            <p class="card-text">
                <?php
                $description = $values->getDescripcion();
                if ($description != NULL) 
                {
                    if (strlen($description) > 280) 
                    {
                        echo substr($description, 0, 280) . "... ";
                        echo "<a href='".FRONT_ROOT."Funcion/ShowFuncionesPelicula/".$values->getId()."' class='card-link text-warning'>Ver mas</a>";
                    } 
                    else 
                    {
                        echo $description;
                    }
                }
                ?>
            </p>
        </div>
        <div class="card-footer pt-2">

            <?php if($values->getVideo() != NULL) { ?>
            <a href="#modal<?php echo $values->getId(); ?>" class="btn btn-danger" data-toggle="modal">Video</a>
            <?php } ?>

            <a href="<?php echo FRONT_ROOT ?>Funcion/ShowFuncionesPelicula/<?php echo $values->getId(); ?>" class="btn btn-warning">Consultar funciones</a>
        </div>
    </div>
</div>

<!-- Modal que muestra video de youtube -->
<?php if($values->getVideo() != null) { ?>
<!-- The Modal -->
<div class="modal" id="modal<?php echo $values->getId(); ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Video <?php echo $values->getTitulo(); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <iframe id="video" width="470" height="340" src="//www.youtube.com/embed/<?php echo $values->getVideo(); ?>?autoplay=1&mute=1" frameborder="0" allowfullscreen></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<?php } ?>