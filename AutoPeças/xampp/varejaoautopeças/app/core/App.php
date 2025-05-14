<?php
namespace app\core;


class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        $url = $this->parseUrl();


        if (!empty($url[0])) {
            $rawControllerName = ucfirst(strtolower($url[0]));
            $controllerCandidate = $rawControllerName . 'Controller';
            if (file_exists('../app/controllers/' . $controllerCandidate . '.php')) {
                $this->controller = $rawControllerName;
                unset($url[0]);
            } else {
                
                $this->show404("Controller '{$controllerCandidate}' não encontrado.");
                return;
            }
        } 

        $controllerClassName = $this->controller . 'Controller';
        $controllerFile = '../app/controllers/' . $controllerClassName . '.php';

        if (!file_exists($controllerFile)){
            $this->show404("Arquivo do controller '{$controllerFile}' não encontrado.");
            return;
        }
        require_once $controllerFile;
        $fullControllerName = "app\controllers\\" . $controllerClassName;
        $this->controller = new $fullControllerName;

        if (isset($url[1])) {
            $methodCandidate = strtolower($url[1]);
            if (method_exists($this->controller, $methodCandidate)) {
                $this->method = $methodCandidate;
                unset($url[1]);
            } else {
                $this->show404("Método '{$methodCandidate}' não encontrado no controller '{$controllerClassName}'.");
                return;
            }
        }

        $this->params = $url ? array_values($url) : [];

        try {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (\Throwable $e) {
            $this->showError("Erro ao executar método: " . $e->getMessage());
        }
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }

    private function show404($message = 'Página não encontrada.') {

        http_response_code(404);
        $errorView = '../app/views/erro/404.php';

             $dados = ['titulo_pagina' => 'Erro 404', 'mensagem_erro' => $message];

        if (file_exists($errorView)) {
            
            extract($dados);
            require_once $errorView;
        } else {
            echo "<h1>Erro 404</h1><p>{$message}</p>";
        }
        exit;
    }

    private function showError($message = 'Ocorreu um erro.') {

        http_response_code(500);

        exit;
    }
}
