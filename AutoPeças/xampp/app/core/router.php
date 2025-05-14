<?php
class Router {
  public static function dispatch($uri) {
    $parts = explode('/', trim($uri, '/'));
    $controller = ucfirst($parts[0] ?: 'Home').'Controller';
    $method = $parts[1] ?? 'index';
    $params = array_slice($parts, 2);

    require "../app/Controllers/$controller.php";
    $obj = new $controller;
    call_user_func_array([$obj, $method], $params);
  }
}
