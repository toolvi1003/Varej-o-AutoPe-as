<?php
namespace app\models;

use app\core\Model;


class ProdutoModel extends Model {

    public function listarTodos() {
        return [
            [
                'id' => 1, 'nome' => 'Kit Freio Esportivo Brembo', 'preco' => 2250.00,
                'imagem' => BASE_URL . 'img/produtos/kitfreio.webp',
                'categoria' => 'Freios e Suspensão', 'descricao_curta' => 'Performance e segurança na frenagem.',
                'promocao' => true,
                'preco_promocional' => 1999.90
            ],
            [
                'id' => 2, 'nome' => 'Roda Esportiva BBS Aro 19', 'preco' => 3800.00,
                'imagem' => BASE_URL . 'img/produtos/bbs-19.png',
                'categoria' => 'Rodas e Pneus', 'descricao_curta' => 'Design clássico e leveza.',
                'promocao' => true,
                'preco_promocional' => 3499.90
            ],
            [
                'id' => 3, 'nome' => 'Farol LED Angel Eyes BMW Série 3', 'preco' => 1200.00,
                'imagem' => BASE_URL . 'img/produtos/farolserie3.webp',
                'categoria' => 'Iluminação', 'descricao_curta' => 'Visual moderno e iluminação eficiente.',
                'promocao' => true,
                'preco_promocional' => 999.90
            ],
            [
                'id' => 4, 'nome' => 'Amortecedor Esportivo Coilover', 'preco' => 1500.00,
                'imagem' => BASE_URL . 'img/produtos/coilover.jpg',
                'categoria' => 'Freios e Suspensão', 'descricao_curta' => 'Ajuste de altura e performance.'
            ],
             [
                'id' => 5, 'nome' => 'Pneu Pirelli P-Zero 245/40 R19', 'preco' => 950.00,
                'imagem' => BASE_URL . 'img/produtos/pneur19.webp',
                'categoria' => 'Rodas e Pneus', 'descricao_curta' => 'Alta performance para supercarros.'
            ],
             [
                'id' => 6, 'nome' => 'Lanterna Traseira LED Fumê Gol G5', 'preco' => 350.00,
                'imagem' => BASE_URL . 'img/produtos/traseiragol.jpg',
                'categoria' => 'Iluminação', 'descricao_curta' => 'Design moderno e diferenciado.'
            ],
            [
                'id' => 7, 'nome' => 'Kit Embreagem Performance Cerâmica', 'preco' => 850.00,
                'imagem' => BASE_URL . 'img/produtos/ceramica.webp',
                'categoria' => 'Motor e Performance', 'descricao_curta' => 'Maior durabilidade e transferência de potência.'
            ],
            [
                'id' => 8, 'nome' => 'Filtro de Ar Esportivo K&N Inbox', 'preco' => 450.00,
                'imagem' => BASE_URL . 'img/produtos/filtro.jpg',
                'categoria' => 'Motor e Performance', 'descricao_curta' => 'Melhora o fluxo de ar para o motor.',
                'descricao_longa' => 'O filtro de ar K&N de alto fluxo foi projetado para aumentar a potência e a aceleração, fornecendo uma excelente filtração. Lavável e reutilizável, dura até 80.000 km antes que a limpeza seja necessária, dependendo das condições de condução.'
            ],
        ];
    }

    public function buscarPorId($id) {
        $todos_produtos = $this->listarTodos();
        foreach ($todos_produtos as $produto) {
            if ($produto['id'] == $id) {
                if (!isset($produto['descricao_longa'])) {
                    $produto['descricao_longa'] = 'Descrição detalhada do produto ' . $produto['nome'] . '. Este produto oferece excelente qualidade e desempenho, sendo uma ótima escolha para suas necessidades. Aproveite as condições especiais de compra e adquira já o seu!';
                }
                return $produto;
            }
        }
        return null;
    }

}
