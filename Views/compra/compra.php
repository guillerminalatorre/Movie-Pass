<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-10 offset-1 bg-dark-transparent rounded pl-4 pr-4 pt-4 shadow">
        <div class="row">

            <!-- Team item -->
            <div class="col-4 mb-5">
                <div class="bg-light rounded shadow-sm py-4 px-4">
                    <a class="btn btn-warning mb-4 shadow-sm" href="<?php echo FRONT_ROOT ?>Funcion/ShowFuncionesPelicula/<?php echo $funcion->getIdPelicula(); ?>" role="button">Volver a funciones</a>
                    <h3 class="title">Items</h3>
                    <ul class="list-group mt-4 mb-4">
                        <li class="list-group-item"><?php echo $cantidad; ?>x Entrada <?php echo $pelicula->getTitulo(); ?><h5 class="text-right">$<?php echo $sala->getPrecio(); ?></h5></li>
                    </ul>
                    <h5 class="text-right">Sub-total: <span><?php echo $subtotal; ?></span></h5>
                    <?php if($descuento != 100) { ?>
                        <h6 class="text-right">Descuento: <span><?php echo $descuento; ?></span></h6>";                        
                    <?php } ?>
                    <h4 class="text-right">Total: <span><?php echo $total; ?></span></h4>
                </div>
            </div><!-- End -->

            <!-- Team item -->
            <div class="col-8 mb-5">                
                <div class="bg-light rounded shadow-sm py-4 px-4">
                    <?php require_once(VIEWS_PATH."alert.php"); ?>
                    <h3>Tarjeta de Credito</h3>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="card-wrapper mt-4"></div>
                        </div>
                    </div>
                    <div class="row py-4 px-4">
                        <form id="cardform" action="<?php echo FRONT_ROOT ?>Compra/Payout" method="POST">
                            <input type="hidden" name="idFuncion" value="<?php echo $idFuncion ?>" />
                            <input type="hidden" name="cantidad" value="<?php echo $cantidad ?>" />
                            <div class="row">
                                <div class="form-group col-7">
                                    <label for="card-holder">Nombre completo</label>
                                    <input id="card-holder" type="text" class="form-control" name="name" placeholder="Nombre Completo" aria-label="Nombre Completo" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-5">
                                    <label for="card-expiry">Fecha de expiracion</label>
                                    <input id="card-expiry" type="tel" class="form-control" name="expiry" placeholder="MMAA" aria-label="MMAA" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-8">
                                    <label for="card-number">Numero de tarjeta</label>
                                    <input id="card-number" type="tel" class="form-control" name="number" placeholder="Numero de Tarjeta" aria-label="Numero de Tarjeta" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-4">
                                    <label for="cvc">Cod.Seguridad</label>
                                    <input id="cvc" type="number" class="form-control" name="cvc" placeholder="CVC" aria-label="CVC" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Finalizar compra</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End -->

        </div>
    </div>
</div>

<script>
    new Card({
        form: document.querySelector('#cardform'),
        container: '.card-wrapper'
    });
</script>