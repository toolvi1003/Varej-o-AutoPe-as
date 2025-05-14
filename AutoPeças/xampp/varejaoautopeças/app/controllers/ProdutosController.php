<?php
namespace app\controllers;

use app\core\Controller;
use app\models\ProdutoModel;


class ProdutosController extends Controller {

    private $produtoModel;


    public function __construct() {
        $this->produtoModel = new ProdutoModel();
    }

    public function index() {
        $todos_produtos = $this->produtoModel->listarTodos();

        $produtos_por_categoria = [];
        foreach ($todos_produtos as $produto) {
            $categoria = $produto['categoria'];
            if (!isset($produtos_por_categoria[$categoria])) {
                $produtos_por_categoria[$categoria] = [];
            }
            $produtos_por_categoria[$categoria][] = $produto;
        }

        ksort($produtos_por_categoria);

        $dados = [
            'titulo_pagina' => 'Nossos Produtos',
            'produtos_por_categoria' => $produtos_por_categoria
        ];

        $this->view('produtos/index', $dados);
    }

    public function detalhes($id = null) {
        if (is_null($id) || !is_numeric($id)) {
            $this->view('erro/404', ['titulo_pagina' => 'ID Inválido', 'mensagem_erro' => 'O ID do produto fornecido é inválido.']);
            return;
        }

        $produto = $this->produtoModel->buscarPorId((int)$id);

        if ($produto) {
            $dados = [
                'titulo_pagina' => $produto['nome'] . ' - Detalhes',
                'produto' => $produto
            ];
            $this->view('produtos/detalhes', $dados);
        } else {
             http_response_code(404);
             $this->view('erro/404', [
                'titulo_pagina' => 'Produto não encontrado',
                'mensagem_erro' => 'O produto com ID ' . htmlspecialchars($id) . ' não foi encontrado em nosso catálogo.'
            ]);
        }
    }
}
