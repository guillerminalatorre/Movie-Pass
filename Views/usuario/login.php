<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container">
  <div class="loginForm">
    <form action="<?php echo FRONT_ROOT ?>Usuario/Login" method="POST">
      <h2 class="text-center">¡Hola! Para seguir, <br>ingresá tus datos</h2>
      <br>
      <div class="form-group">
        <label for="userEmail">Email</label>
        <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
      </div>
      <div class="form-group">
        <label for="userPassword">Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar sesion</button>
      <a class="btn btn-primary btn-lg btn-block" href="<?php echo htmlspecialchars($facebookLoginUrl); ?>" role="button"><i class="fab fa-facebook-f"></i>  Iniciar sesion con Facebook</a>
      <br>
      <div class="text-center">
        <a class="" href="#">Olvidaste tu contraseña?</a>
      </div>
    </form>
    <div class="dropdown-divider mt-5"></div>
    <p class="message text-center">Eres nuevo? <a href="<?php echo FRONT_ROOT ?>Home/Register"> Registrate</a></p>
  </div>
</div>