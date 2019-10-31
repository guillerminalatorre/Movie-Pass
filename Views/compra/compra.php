<?php require_once(VIEWS_PATH."navbar.php"); ?>
<main class="page payment-page">
    <section class="payment-form">
        <div class="container-fluid">
            <div class="row">
            <form>
                <div class="products">
                    <h3 class="title">Checkout</h3>
                    <div class="row">
                        <div class="col-sm-12 item">
                            <span class="price">$200</span>
                            <p class="item-name">Product 1</p>
                            <p class="item-description">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                    <div class="total">Total<span class="price">$320</span></div>
                </div>
                <div class="card-details">
                    <h3 class="title">Credit Card Details</h3>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <div class="card-wrapper"></div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="<?php echo FRONT_ROOT ?>Compra/Payout/<?php echo $idFuncion; ?>/<?php echo $cantidad; ?>" method="POST">
                            <div class="form-group col-sm-7">
                                <label for="card-holder">Nombre completo</label>
                                <input id="card-holder" type="text" class="form-control" name="name" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="">Fecha de expiracion</label>
                                <div class="input-group expiration-date">
                                    <input type="tel" class="form-control" name="expiry" placeholder="MMYY" aria-label="MMYY" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="card-number">Numero de tarjeta</label>
                                <input id="card-number" type="tel" class="form-control" name="number" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="cvc">Cod.Seguridad</label>
                                <input id="cvc" type="number" class="form-control" name="cvc" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Finalizar compra</button>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
</main>

<script>
    new Card({
        form: document.querySelector('form'),
        container: '.card-wrapper'
    });
</script>