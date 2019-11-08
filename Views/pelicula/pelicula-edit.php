<div class="modal" id="modal<?php echo $pelicula->getId(); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo FRONT_ROOT ?>Pelicula/Update" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar <?php echo $pelicula->getTitulo(); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">                
                    <div class="row">
                        <div class="col-12 text-center mb-2">
                            <img src="<?php echo $pelicula->getPoster(); ?>" height="100" width="100" class="rounded-circle z-depth-0" alt="avatar">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="nombre">Imagen:</label>
                        </div>
                        <div class="col-9">
                            <input type="file" name ="image" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="idPelicula">ID Pelicula:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="idPelicula" readonly="readonly" value="<?php echo $pelicula->getId(); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="titulo">Titulo:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="titulo" value="<?php echo $pelicula->getTitulo();?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="duracion">Duracion:</label>
                        </div>
                        <div class="col-9">
                            <input type="number" class="form-control" name="duracion" value="<?php echo $pelicula->getDuracion();?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="descripcion">Descripcion:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="descripcion" value="<?php echo $pelicula->getDescripcion();?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="idioma">Idioma:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="idioma" value="<?php echo $pelicula->getIdioma();?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="clasificacion">Clasificacion:</label>
                        </div>
                        <div class="col-9">
                            <input type="number" class="form-control" name="clasificacion" value="<?php echo $pelicula->getClasificacion();?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="video">Video:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="video" value="<?php echo $pelicula->getVideo();?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="popularidad">Popularidad:</label>
                        </div>
                        <div class="col-9">
                            <input type="number" class="form-control" name="popularidad" value="<?php echo $pelicula->getPopularidad();?>" required>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success shadow-sm">Guardar</button>
                    <button type="button" class="btn btn-danger shadow-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>