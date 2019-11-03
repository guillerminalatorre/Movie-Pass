<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-white rounded shadow p-md-4 p-lg-4 p-xl-5">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <form action="<?php echo FRONT_ROOT ?>Usuario/Register" method="POST">
            <div class="row">
                <div class="form-group col">
                    <a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Login" role="button">Volver a login</a>
                </div>
                <div class="form-group col text-center">
                    <h2>Registro</h2>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="example@example.com" required>
                </div>
            </div>            
            <div class="row">
                <div class="form-group col">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="dni">Dni:</label>
                    <input type="number" class="form-control" name="dni" required>
                </div>
            </div>            
            <div class="row">
                <div class="form-group col">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group col">
                    <label for="confirmpassword">Repite tu contraseña:</label>
                    <input type="password" class="form-control" name="confirmpassword" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm">Crear cuenta</button>
        </form>
    </div>
</div>