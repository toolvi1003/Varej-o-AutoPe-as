<?php


define('DB_HOST', 'localhost');       
define('DB_USER', 'root');
define('DB_PASS', '');               
define('DB_NAME', 'varejao'); 
define('ROOT_PATH', dirname(dirname(__FILE__)));

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$subfolder_path = '/xampp/varejaoautopeças/publico';

define('BASE_URL', $protocol . $host . $subfolder_path);


define('SITE_NAME', 'Varejão Auto Peças'); 
define('APP_VERSION', '1.0.0');           

ini_set('display_errors', 1);            
ini_set('display_startup_errors', 1);   
error_reporting(E_ALL);                   

?>