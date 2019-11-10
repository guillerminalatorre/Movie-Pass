<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
  <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-light rounded shadow p-md-4 p-lg-4 p-xl-5">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <form action="<?php echo FRONT_ROOT ?>Usuario/Login" method="POST">
      <h2 class="text-center">¡Hola! Para seguir, <br>ingresá tus datos</h2>
      <div class="form-group mt-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm">Iniciar sesion</button>
      <a class="btn btn-primary btn-lg btn-block shadow-sm" href="<?php echo htmlspecialchars($facebookLoginUrl); ?>" role="button"><i class="fab fa-facebook-f"></i>  Iniciar sesion con Facebook</a>
      <div class="text-center pt-4 pb-2 border-bottom"><a class="" href="#"><h6>Olvidaste tu contraseña?</a></h6></div>    
      <div class="pt-4 pb-2 mb-2"><h6>Eres nuevo? <a href="<?php echo FRONT_ROOT ?>Register"> Registrate</a></h6></div>
    </form>    
  </div>
</div>