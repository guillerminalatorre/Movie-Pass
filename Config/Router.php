<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:09
	 */
	namespace Config;

	use Config\Request as Request;
	
	class Router
	{
		/**
		 * 
		 * @param request
		 */
		public static function Route(Request $request)
		{
			$controllerName = $request->getcontroller() . 'Controller';

			$methodName = $request->getmethod();

			$methodParameters = $request->getparameters();          

			$controllerClassName = "Controllers\\". $controllerName;            

			$controller = new $controllerClassName;
			
			if(!isset($methodParameters))            
				call_user_func(array($controller, $methodName));
			else
				call_user_func_array(array($controller, $methodName), $methodParameters);
		}
	}
?>