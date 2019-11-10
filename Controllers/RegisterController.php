<?php
	namespace Controllers;

	use Models\Usuario as Usuario;

	class RegisterController extends Administrable
	{
		public function Index()
		{
			if($this->loggedIn()) Functions::redirect("Home");
						
			require_once(VIEWS_PATH."usuario/register.php");
		}
	}
?>