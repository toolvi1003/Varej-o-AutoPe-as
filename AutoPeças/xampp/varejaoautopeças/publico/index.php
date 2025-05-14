<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/config/config.php';

spl_autoload_register(function ($className) {
    $prefix = 'app\\';
    $base_dir = ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR; 

    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        return;
    }

    $relative_class = substr($className, $len);

    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        error_log("Autoloader: Arquivo não encontrado para a classe: " . $className . " (esperado em: " . $file . ")");
    }
});

$app = new app\core\App();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$router = new app\core\Router(); 
$router->dispatch();

?>
