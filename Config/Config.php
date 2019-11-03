<?php
	namespace Config;

	define("PROTOCOL", "http://");
	define("WWW", "localhost");
	define("ROOT", dirname(__DIR__)."/");
	define("FRONT_ROOT", "/TP-Metodologia/");
	define("UPLOADS_PATH", "Uploads/");
	define("VIEWS_PATH", "Views/");
	define("CSS_PATH", VIEWS_PATH."css/");
	define("JS_PATH", VIEWS_PATH."js/");
	define("IMG_PATH", VIEWS_PATH."img/");

	define("API", "https://api.themoviedb.org/3");
	define("API_KEY", "6a65158231eaaf71a3446b747cff20ec");
	define("LANGUAGE_ES", "es");

	define("FACEBOOK_API", "417391325441189");
	define("FACEBOOK_SECRET", "67fbf5704267023c39712b1befaf9477");

	define("DB_HOST", "metroline.com.ar");
	define("DB_NAME", "moviepass");
	define("DB_USER", "metroline");
	define("DB_PASS", "rodrii01");
?>