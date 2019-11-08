<?php
	namespace Controllers;

	use Models\Usuario as Usuario;

	class HomeController
	{
		public function Index()
		{
			Functions::redirect("Funcion","ShowMovies");
		}
	}
?>
