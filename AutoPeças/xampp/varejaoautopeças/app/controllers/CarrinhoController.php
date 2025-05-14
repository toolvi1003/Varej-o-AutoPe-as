<?php
namespace app\controllers;

use app\core\Controller;
use app\models\ProdutoModel;

class CarrinhoController extends Controller {

    private $produtoModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->produtoModel = new ProdutoModel();
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    public function index() {
        $itens_carrinho = [];
        $total_carrinho = 0.0;

        if (!empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $produto_id => $item) {
                $produto_info = $this->produtoModel->buscarPorId($produto_id);
                if ($produto_info) {
                    $subtotal = $produto_info['preco'] * $item['quantidade'];
                    $itens_carrinho[] = [
                        'id' => $produto_id,
                        'nome' => $produto_info['nome'],
                        'preco' => $produto_info['preco'],
                        'imagem' => $produto_info['imagem'],
                        'quantidade' => $item['quantidade'],
                        'subtotal' => $subtotal
                    ];
                    $total_carrinho += $subtotal;
                }
            }
        }

        $dados = [
            'titulo_pagina' => 'Meu Carrinho de Compras',
            'itens_carrinho' => $itens_carrinho,
            'total_carrinho' => $total_carrinho
        ];

        $this->view('carrinho/index', $dados);
    }

    public function adicionar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produto_id'])) {
            $produto_id = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
            $quantidade = isset($_POST['quantidade']) ? filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT) : 1;

            if ($produto_id && $quantidade > 0) {
                $produto_info = $this->produtoModel->buscarPorId($produto_id);
                if ($produto_info) { 
                    if (isset($_SESSION['carrinho'][$produto_id])) {
                        $_SESSION['carrinho'][$produto_id]['quantidade'] += $quantidade;
                    } else {
                        
                        $_SESSION['carrinho'][$produto_id] = [
                            'produto_id' => $produto_id,
                            'nome' => $produto_info->nome, 
                            'preco' => $produto_info->preco, 
                            'quantidade' => $quantidade
                        ];
                    }
                } 
            } 
        } 

        header('Location: ' . BASE_URL . '/carrinho');
        exit;
    }

    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produto_id']) && isset($_POST['quantidade'])) {
            $produto_id = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

            if ($produto_id && $quantidade > 0) {
                if (isset($_SESSION['carrinho'][$produto_id])) {
                    $_SESSION['carrinho'][$produto_id]['quantidade'] = $quantidade;
                }

                unset($_SESSION['carrinho'][$produto_id]);
            }
        }
        header('Location: ' . BASE_URL . '/carrinho');
        exit;
    }

    public function remover($produto_id_param = null) {
        $produto_id = filter_var($produto_id_param, FILTER_VALIDATE_INT);

        if ($produto_id) {
            unset($_SESSION['carrinho'][$produto_id]);
        }
        header('Location: ' . BASE_URL . '/carrinho');
        exit;
    }

    public function limpar() {
        $_SESSION['carrinho'] = [];
        header('Location: ' . BASE_URL . '/carrinho');
        exit;
    }
}
