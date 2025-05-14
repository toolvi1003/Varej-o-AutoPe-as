<?php

namespace app\core; 



class Controller {


    public function model($modelNome) {
        
        $caminhoModel = ROOT_PATH . '/app/models/' . ucfirst($modelNome) . '.php';

        
        if (file_exists($caminhoModel)) {
            require_once $caminhoModel;
            
            $nomeClasseModel = ucfirst($modelNome);
            if (class_exists($nomeClasseModel)) {
                return new $nomeClasseModel();
            }
        }
        
        error_log("Model não encontrado: " . $caminhoModel);
        return false;
    }


    public function view($viewNome, $dados = [], $layoutNome = 'layout') {
        
        $caminhoView = ROOT_PATH . '/app/views/' . $viewNome . '.php';

        if (file_exists($caminhoView)) {
            
            extract($dados);

            
            if ($layoutNome) {
                $caminhoLayout = ROOT_PATH . '/app/views/' . $layoutNome . '.php'; 
                if (strpos($layoutNome, 'layouts/') === false && file_exists(ROOT_PATH . '/app/views/layouts/' . $layoutNome . '.php')) {
                    
                    $caminhoLayout = ROOT_PATH . '/app/views/layouts/' . $layoutNome . '.php';
                }


                if (file_exists($caminhoLayout)) {
                    
                    $view_content_for_layout = $caminhoView; 
                    require_once $caminhoLayout;
                } else {
                    
                    error_log("Layout não encontrado: " . $caminhoLayout . ". Carregando view diretamente.");
                    require_once $caminhoView;
                }
            } else {
                
                require_once $caminhoView;
            }
        } else {
            
            die('Erro: View não encontrada: ' . $caminhoView);
        }
    }
}
?>