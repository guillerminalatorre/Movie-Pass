<?php

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */

namespace Controllers;

use Models\Usuario as Usuario;
use Config\Functions as Functions;

class HomeController
{
	public function Index()
	{
		Functions::getInstance()->redirect("Funcion","showMovies");
	}
}
