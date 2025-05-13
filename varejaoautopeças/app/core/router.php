<?php

namespace app\core; 



class Router {
    protected $currentController = 'HomeController'; 
    protected $currentMethod = 'index';             
    protected $params = [];                         

    public function __construct() {
        
    }


    public function dispatch() {
        $url = $this->getUrl();

        
        if (isset($url[0]) && !empty($url[0])) {
            
            $controllerName = ucwords(str_replace('-', '', $url[0]), '') . 'Controller';
            $controllerFile = ROOT_PATH . '/app/controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                $this->currentController = $controllerName;
                unset($url[0]); 
            } else {
                error_log("Router: Controller não encontrado: " . $controllerFile . ". Usando padrão: " . $this->currentController);
            }
        }

        
        $controllerClassName = 'app\\controllers\\' . $this->currentController;

        
        $controllerFile = ROOT_PATH . '/app/controllers/' . $this->currentController . '.php';

        
        if (!file_exists($controllerFile)) {
            $this->triggerError(404, "Router: Arquivo do Controller não encontrado: " . $controllerFile);
            return;
        }

        
        require_once $controllerFile;

        
        if (class_exists($controllerClassName)) {
            
            $controllerInstance = new $controllerClassName();
            
            $this->currentController = $controllerInstance;
        } else {
            $this->triggerError(500, "Router: Classe do Controller não pôde ser carregada: " . $controllerClassName);
            return; 
        }

        
        if (isset($url[1]) && !empty($url[1])) {
            
            $methodName = lcfirst(ucwords(str_replace('-', '', $url[1]), ''));

            if (method_exists($this->currentController, $methodName)) {
                $this->currentMethod = $methodName;
                unset($url[1]); 
            } else {
                error_log("Router: Método não encontrado em " . get_class($this->currentController) . ": " . $methodName . ". Usando padrão: " . $this->currentMethod);

            }
        }
        
        
        $this->params = $url ? array_values($url) : [];

        
        try {
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } catch (TypeError $e) {
            $this->triggerError(500, "Router: Erro ao chamar método: " . get_class($this->currentController) . "->" . $this->currentMethod . " - " . $e->getMessage());
        } catch (Error $e) { 
            $this->triggerError(500, "Router: Erro fatal ao chamar método: " . get_class($this->currentController) . "->" . $this->currentMethod . " - " . $e->getMessage());
        }
    }


    protected function getUrl() {
        $url = '';
        
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/') {
            
            $requestUri = $_SERVER['REQUEST_URI'];
            $baseUrlPath = parse_url(BASE_URL, PHP_URL_PATH); 

            
            if ($baseUrlPath && $baseUrlPath !== '/') {
                 
                $baseUrlPath = rtrim($baseUrlPath, '/');
                if (strpos($requestUri, $baseUrlPath) === 0) {
                    $url = substr($requestUri, strlen($baseUrlPath));
                } else {
                    
                    $url = $requestUri;
                }
            } else {
                 
                $url = $requestUri;
            }

            
            $url = strtok($url, '?');
            
            $url = trim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return !empty($url) ? explode('/', $url) : [];
        }
        return []; 
    }


    protected function triggerError($code = 404, $message = "Página não encontrada.") {
        http_response_code($code);
        
        
        echo "<h1>Erro {$code}</h1>";
        echo "<p>{$message}</p>";
         
    }
}
?>