<div class="container">
    <div class="panelForm">
        <form action="<?php echo FRONT_ROOT ?>Usuario/UpdateUser" method="POST">
            <div class="row">
                <div class="form-group col-sm">
                    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Home/ViewProfile/<?php echo $usuario->getEmail(); ?>" role="button">Volver a perfil</a>
                </div>
                <div class="form-group col-sm text-center">
                    <h2>Modificar perfil</h2>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $usuario->getEmail();?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $usuario->getNombre();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $usuario->getApellido();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="dni">Dni:</label>
                    <input type="text" class="form-control" name="dni" value="<?php echo $usuario->getDni();?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="password">Contraseña anterior:</label>
                    <input type="password" class="form-control" name="previouspassword" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="password">Contraseña nueva:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group col-sm">
                    <label for="confirmpassword">Repite contraseña:</label>
                    <input type="password" class="form-control" name="confirmpassword">
                </div>
            </div>
            <div class="row">
                <div class="file-field">
                    <div class="btn btn-primary btn-lg">
                        <span><i class="fas fa-user"></i> Imagen de perfil (MAX: 3MB)</span>
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <input class="mt-2" type="file">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block mt-2"><i class="fas fa-plus-circle"></i> Actualizar datos</button>
            </div>
        </form>
        <!-- <button class="btn btn-primary btn-lg btn-block"><i class="fab fa-facebook-f"></i>  Iniciar sesion con Facebook</button> -->
    </div>
</div>