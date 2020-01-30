<?php

 	// Database configuration

    define('DB_SERVER', 'localhost');
    define('DB_NAME', 'bozoksis');
    define('DB_CHARSET', 'utf8');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');



    // For site path 
    $dirnametemp = strtolower(dirname($_SERVER['SCRIPT_NAME']));
	$dirname1 = $dirnametemp != '/' ? $dirnametemp : null;

    define('SITE_PATH', 'localhost'.$dirname1);
    define('SITE_URL', 'http://localhost'.$dirname1);
    	  	


?>