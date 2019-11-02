<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-md-10 offset-md-1 bg-dark rounded pl-4 pr-4 pt-4 shadow">
        <div class="row">

            <!-- Team item -->
            <div class="col-4 mb-5">
                <div class="bg-white rounded shadow-sm py-4 px-4">
                    <h3 class="title">Items</h3>
                    <ul class="list-group mt-4 mb-4">
                        <li class="list-group-item">1x Entrada Joker</li>
                    </ul>
                    <h4>Total <span>$320</span></h4>
                </div>
            </div><!-- End -->

            <!-- Team item -->
            <div class="col-8 mb-5">
                <div class="bg-white rounded shadow-sm py-4 px-4">
                    <h3>Tarjeta de Credito</h3>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="card-wrapper mt-4"></div>
                        </div>
                    </div>
                    <div class="row py-4 px-4">
                        <form id="cardform" action="<?php echo FRONT_ROOT ?>Compra/Payout/<?php echo $idFuncion; ?>/<?php echo $cantidad; ?>" method="POST">
                            <div class="row">
                                <div class="form-group col-7">
                                    <label for="card-holder">Nombre completo</label>
                                    <input id="card-holder" type="text" class="form-control" name="name" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-5">
                                    <label for="">Fecha de expiracion</label>
                                    <div class="input-group expiration-date">
                                        <input type="tel" class="form-control" name="expiry" placeholder="MMYY" aria-label="MMYY" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="form-group col-8">
                                    <label for="card-number">Numero de tarjeta</label>
                                    <input id="card-number" type="tel" class="form-control" name="number" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-4">
                                    <label for="cvc">Cod.Seguridad</label>
                                    <input id="cvc" type="number" class="form-control" name="cvc" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
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