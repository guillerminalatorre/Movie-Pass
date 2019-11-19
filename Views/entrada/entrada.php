<div class="modal" id="modal<?php echo $entrada->getId(); ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Entrada #<?php echo $entrada->getId(); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">                
                    <div class="row">
                        <div class="col-12 text-center mb-2">

                          <div class="ticket col-12">
                          <div class="row">
                            <div class="stub col-sm-12 col-md-5 col-12">
                              <div class="top">
                                <span class="admit">ENTRADA</span>
                                <span class="line"></span>
                                <span class="num">
                                  Funcion
                                  <span><?php echo $idFuncion; ?></span>
                                </span>
                              </div>
                              <div class="number"><?php echo $entrada->getId(); ?></div>
                              <div class="invite">
                              <img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=<?php echo $entrada->getQr(); ?>" class="rounded-circle z-depth-0" alt="qr">
                              </div>
                            </div>
                            <div class="check col-sm-12 col-md-7 col-12">
                              <div class="big">
                                <?php 
                                $title = $pelicula->getTitulo();
                                if (strlen($title) > 20) echo substr($title, 0, 20)."...";
                                ?>
                              </div>
                              <div class="number">#<?php echo $entrada->getId(); ?></div>
                              <div class="info">
                                <section>
                                  <div class="title">Fecha</div>
                                  <div><?php echo date("d/m/Y H:i",strtotime($funcion->getFechaHora())); ?></div>
                                </section>
                                <section>
                                  <div class="title">Nombre</div>
                                  <div><?php echo $_SESSION['loggedUser']->getNombre()." ".$_SESSION['loggedUser']->getApellido(); ?></div>
                                </section>
                                <section>
                                  <div class="title">Compra</div>
                                  <div>#<?php echo $entrada->getIdCompra(); ?></div>
                                </section>
                              </div>
                            </div>
                          </div>
                          </div>

                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger shadow-sm" data-dismiss="modal">Cerrar</button>
                </div>

        </div>
    </div>
</div>