<?php

   define("domain", $_SERVER['SERVER_NAME']);

	if ( domain == "localhost" ){		
		define("db_server", "localhost");
		define("db_user", "root");
		define("db_password", "2857811");
		define("db_bdata", "quienlocompra");
	}else{

		define("db_server", "localhost");
		define("db_user", "qlcAdfs");
		define("db_password", "sXatQaui5");
		define("db_bdata", "quienlocompra");
		
	}

	//Datos de la página
	define("site_name", "Quienlocompra" );
	define("site_author", "Dannegm, Gomosoft" );
	define("site_owned", "Dannegm, Gomosoft" );
	

   //variables
	define("zona_horaria","America/Bogota");
    define("errores","true");
    define("serv_key","");
    define("serv_secret","");
    define("so","ubuntu server");      



	define("site_url", "http://quienlocompra.com" );
	define("site_info_email", "info@quienlocompra.com" );
	define("site_dev_email", "dev@quienlocompra.com" );

	// Directorios
	define("dirjs", "//" . domain . "/js");
	define("dircss", "//" . domain . "/css");
	define("dirapps", "//" . domain . "/apps");
	define("dirclass", "//" . domain . "/class");
	define("dirpages", "//" . domain . "/pages");
	define("dirimg", "//" . domain . "/img");
	define("dirpic", "//" . domain . "/pictures");	

	//Base de datos
	define("tb_apps", "apps");
	define("tb_articles", "articles");
	define("tb_comments", "comments");
	define("tb_messages", "messages");
	define("tb_notifications", "notifications");
	define("tb_pictures", "pictures");
	define("tb_users", "users");

?>