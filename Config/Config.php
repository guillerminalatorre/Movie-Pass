<?php
	namespace Config;

	define("ROOT", dirname(__DIR__)."/");
	define("FRONT_ROOT", "/TP-Metodologia/");
	define("UPLOADS_PATH", "Uploads/");
	define("VIEWS_PATH", "Views/");
	define("CSS_PATH", FRONT_ROOT.VIEWS_PATH."css/");
	define("JS_PATH", FRONT_ROOT.VIEWS_PATH."js/");
	define("IMG_PATH", FRONT_ROOT.VIEWS_PATH."img/");	
	define("API", "https://api.themoviedb.org/3");
	define("API_KEY", "6a65158231eaaf71a3446b747cff20ec");
	define("LANGUAGE_ES", "es");

	define("DB_HOST", "localhost");
	define("DB_NAME", "moviepass");
	define("DB_USER", "root");
	define("DB_PASS", "");
?>