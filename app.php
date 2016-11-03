<?php
// Zato sto, nikad ne znas sta ce korisnik da uradi sa urlom...
$_SERVER['REQUEST_URI'] = rtrim($_SERVER['REQUEST_URI'], "/")."/";

require_once(__DIR__."/vendor/autoload.php");

if(getenv("DATABASE_URL") != ""){
	$url = parse_url(getenv("DATABASE_URL"));

	$config = array(
		'driver' => 'mysql', 
		'host' => $url["host"], 
		'database' => substr($url["path"], 1), 
		'username' => $url["user"], 
		'password' => $url["pass"], 
		'charset' => 'utf8', 
		'collation' => 'utf8_unicode_ci'
	);
} else {
	$config = array(
		'driver' => 'mysql', 
		'host' => 'localhost', 
		'database' => 'panel', 
		'username' => 'root', 
		'password' => '', 
		'charset' => 'utf8', 
		'collation' => 'utf8_unicode_ci'
	);
}

new \Pixie\Connection('mysql', $config, 'QB');

require_once(__DIR__."/middleware/index.php");
require_once(__DIR__."/views/index.php");
require_once(__DIR__."/routes/index.php");

