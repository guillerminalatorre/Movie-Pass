<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use Models\Usuario as Usuario;
use API\FBController as FBController;

class LoginController extends Administrable
{
    public function Index()
	{
		$_SESSION['flash'] = array();
		if($this->loggedIn()) Functions::redirect("Home");
		
		$facebookLoginUrl = $this->getFacebookLoginUrl();
		require_once(VIEWS_PATH."usuario/login.php");
	}

	private function getFacebookLoginUrl()
	{
		$fb = FBController::getFacebookAPI();
		$helper = $fb->getRedirectLoginHelper();
		return $helper->getLoginUrl(PROTOCOL.WWW.FRONT_ROOT."Usuario/FacebookLogin");
	}
}