<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	class HomeController
	{
		public function Index($message = "")
		{
			require_once(VIEWS_PATH."searchbar.php");
		}
	}
?>