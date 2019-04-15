<?php

	// DB Host
	$db["db_host"] = "localhost";
	// DB Username
	$db["db_user"] = "root";
	// DB Password	
	$db["db_pass"] = "";
	// DB Name
	$db["db_name"] = "brac_bazar";

	foreach ($db as $key => $value) {
		define(strtoupper($key), $value);
	}

	// Database Connected Variable

	$db_connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

	
	/*if( $db_connect ){
		echo "Database Connected";
	}else{
		echo "Database Connection Failed!";
	}*/
	

?>