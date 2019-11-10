    <div class="container-fluid mb-4">
        <div class="col-md-10 offset-sm-0 offset-md-1 bg-custom-transparent rounded shadow p-2">
            <div class="container-fluid my-4">

                <div class="row my-4">
                    <div class="col-md-3 ">
                        <img class="rounded shadow img-fluid" src="<?php echo $pelicula->getPoster(); ?> " alt="Poster image">
                    </div>
                    <div class="col-md-9 shadow text-white bg-dark-transparent rounded ">
                        
                        <h2 class="mt-4"><?php echo $pelicula->getTitulo(); ?></h2>
                        <div class="rating">
                            <p><i class="fas fa-star " style="color: gold;"></i><?php echo " " . $pelicula->getPopularidad() . "/10"; ?></p>
                            <p><i class="fas fa-film"></i><?php echo " " . date_format(date_create($pelicula->getFechaDeEstreno()), "Y"); ?></p>
                            <p><i class="far fa-clock"></i><?php echo " " . $pelicula->getDuracion(); ?> min</p>
                            <p><i class="fas fa-play"></i><?php echo " ";  ?> </p>
                        </div>
                        <div class="card-text ">
                            <p>
                                <?php
                                echo $pelicula->getDescripcion();
                                ?> </p>
                        </div>

                        <div>
                            <?php if ($pelicula->getVideo() != NULL) { ?>
                                <a href="#modal<?php echo $pelicula->getId(); ?>" class="btn shadow btn-danger float-right mr-4" data-toggle="modal">Ver trailer</a>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal que muestra video de youtube -->
    <?php if ($pelicula->getVideo() != null) { ?>
        <!-- The Modal -->
        <div class="modal" id="modal<?php echo $pelicula->getId(); ?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Video <?php echo $pelicula->getTitulo(); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <iframe id="video" width="470" height="340" src="//www.youtube.com/embed/<?php echo $pelicula->getVideo(); ?>?autoplay=1&mute=1" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>