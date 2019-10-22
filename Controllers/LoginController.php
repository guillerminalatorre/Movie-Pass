<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use Models\Usuario as Usuario;

class LoginController
{
    public function Index()
	{
		$usuarioController = new UsuarioController();
		$facebookLoginUrl = $usuarioController->getFacebookLoginUrl();
		require_once(VIEWS_PATH."usuario/login.php");
	}
}