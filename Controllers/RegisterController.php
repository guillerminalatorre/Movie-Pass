<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use Models\Usuario as Usuario;

class RegisterController extends Administrable
{
    public function Index()
	{
		$_SESSION['flash'] = array();
		if($this->loggedIn()) Functions::redirect("Home");
		
		require_once(VIEWS_PATH."usuario/register.php");
	}
}