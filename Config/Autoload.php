<?php




/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:09
 */
class Autoload
{

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public static function start()
	{
		spl_autoload_register(function($className)
					{
		                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
		                
						include_once($classPath);
					});
	}

}
?>