<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container">
    <div class="registerForm">
        <form action="<?php echo FRONT_ROOT ?>Usuario/Register" method="POST">
            <div class="row">
                <div class="form-group col-sm">
                    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Home/Login" role="button">Volver a login</a>
                </div>
                <div class="form-group col-sm text-center">
                    <h2>Registro</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-sm">
                    <label for="dni">Dni:</label>
                    <input type="number" class="form-control" name="dni" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="example@example.com" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group col-sm">
                    <label for="confirmpassword">Repite tu contraseña:</label>
                    <input type="password" class="form-control" name="confirmpassword" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Crear cuenta</button>
        </form>
    </div>
</div>