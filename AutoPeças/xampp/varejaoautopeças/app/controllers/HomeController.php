<?php

namespace app\controllers;
use app\core\Controller;
use app\models\ProdutoModel;

class HomeController extends Controller {


    public function index() {
        $produtoModel = new ProdutoModel();
        $todos_produtos = $produtoModel->listarTodos();

        $categoria_selecionada = null;
        $produtos_filtrados = $todos_produtos;

        if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
            $categoria_selecionada = urldecode($_GET['categoria']);
            $produtos_filtrados = array_filter($todos_produtos, function($produto) use ($categoria_selecionada) {
                return isset($produto['categoria']) && $produto['categoria'] === $categoria_selecionada;
            });
        }

        $categorias = [];
        foreach ($todos_produtos as $produto) {
            if (isset($produto['categoria']) && !in_array($produto['categoria'], $categorias)) {
                $categorias[] = $produto['categoria'];
            }
        }
        sort($categorias);

        $produtos_promocao = array_slice($todos_produtos, 0, 3);

        $dados = [
            'titulo' => 'Página Inicial - Varejão Auto Peças',
            'produtos' => $produtos_filtrados,
            'produtos_promocao' => $produtos_promocao,
            'categorias' => $categorias,
            'categoria_selecionada' => $categoria_selecionada
        ];

        $this->view('home/index', $dados);
    }

    public function detalhes($id = 0) {
        $id = (int)$id;

        $todos_produtos = [
            [
                'id' => 1,
                'nome' => 'Kit Freio Esportivo Brembo',
                'descricao_curta' => 'Performance de frenagem superior para seu veículo.',
                'descricao_longa' => 'O Kit de Freio Esportivo Brembo oferece o máximo em performance e segurança para seu veículo. Inclui discos perfurados e ventilados, pinças de 4 pistões e pastilhas de composto cerâmico para maior durabilidade e menor ruído.',
                'especificacoes' => 'Discos: 355mm perfurados e ventilados\nPinças: 4 pistões em alumínio\nPastilhas: Composto cerâmico\nAplicação: Diversos modelos (consultar)',
                'preco' => 2500.00,
                'preco_promocional' => 2250.00,
                'imagem' => 'https://placehold.co/600x400/D73737/FFF?text=Freio+Brembo',
                'categoria' => 'Performance',
                'promocao' => true
            ],
            [
                'id' => 2,
                'nome' => 'Roda Esportiva BBS Aro 19',
                'descricao_curta' => 'Design exclusivo e leveza para seu carro.',
                'descricao_longa' => 'As rodas BBS modelo CH-R combinam design clássico de competição com tecnologia moderna de fabricação flow-forming, resultando em uma roda leve e resistente. Ideal para quem busca estilo e performance.',
                'especificacoes' => 'Modelo: CH-R\nAro: 19 polegadas\nTala: 8.5J\nFuração: 5x112 (consultar outras)\nMaterial: Alumínio Flow-Formed\nCor: Prata Diamantado',
                'preco' => 3800.00,
                'preco_promocional' => null,
                'imagem' => 'https://placehold.co/600x400/1a1a1a/FFF?text=Roda+BBS',
                'categoria' => 'Rodas e Pneus',
                'promocao' => false
            ],
            [
                'id' => 3,
                'nome' => 'Farol LED Angel Eyes BMW Série 3',
                'descricao_curta' => 'Visua
                l moderno e iluminação eficiente.',
                'descricao_longa' => 'Atualize o visual da sua BMW Série 3 (E90/E92) com este par de faróis com projetor e Angel Eyes em LED. Proporcionam iluminação superior e um design muito mais moderno e agressivo.',
                'especificacoes' => 'Tecnologia: LED (Angel Eyes e Setas)\nProjetor: Sim (para luz baixa)\nLâmpadas (não inclusas): H7 (baixa), H1 (alta)\nCompatibilidade: BMW Série 3 E90/E92 (Pré-LCI)\nInstalação: Plug and Play (pode requerer codificação)',
                'preco' => 1200.00,
                'preco_promocional' => 1050.00,
                'imagem' => 'https://placehold.co/600x400/D73737/FFF?text=Farol+LED',
                'categoria' => 'Iluminação',
                'promocao' => true
            ],
            [
                'id' => 4,
                'nome' => 'Kit Suspensão Coilover Regulável',
                'descricao_curta' => 'Ajuste a altura e a dirigibilidade do seu veículo.',
                'descricao_longa' => 'Este kit de suspensão coilover permite ajustar a altura do veículo e a carga das molas, proporcionando um controle preciso sobre a dirigibilidade e o visual do carro. Ideal para uso em rua e track days.',
                'especificacoes' => 'Tipo: Coilover\nAjustes: Altura, Carga de Mola (em alguns modelos)\nMaterial: Corpo em aço galvanizado, molas em aço de alta resistência\nAplicação: Vários modelos (consultar)',
                'preco' => 1900.00,
                'preco_promocional' => null,
                'imagem' => 'https://placehold.co/600x400/1a1a1a/FFF?text=Suspensão',
                'categoria' => 'Performance',
                'promocao' => false
            ],
            [
                'id' => 5,
                'nome' => 'Central Multimídia Android 10\" Tela HD',
                'descricao_curta' => 'GPS, Bluetooth, Espelhamento e muito mais.',
                'descricao_longa' => 'Transforme o painel do seu carro com esta central multimídia completa. Possui tela HD de 10 polegadas sensível ao toque, sistema Android, GPS integrado, Bluetooth para chamadas e música, espelhamento de celular (Android/iOS) e entradas USB.',
                'especificacoes' => 'Sistema Operacional: Android\nTela: 10\" HD Touchscreen\nConectividade: GPS, Wi-Fi, Bluetooth, USB\nFunções: Rádio FM, Player de Vídeo/Música, Espelhamento\nMemória: 2GB RAM / 32GB ROM (pode variar)',
                'preco' => 950.00,
                'preco_promocional' => 850.00,
                'imagem' => 'https://placehold.co/600x400/D73737/FFF?text=Multimídia',
                'categoria' => 'Interior e Som',
                'promocao' => true
            ],
            [
                'id' => 6,
                'nome' => 'Pneu Michelin Pilot Sport 4S 255/35R19',
                'descricao_curta' => 'Alta performance para carros esportivos.',
                'descricao_longa' => 'O Michelin Pilot Sport 4S é um pneu de ultra alta performance, desenvolvido para carros esportivos e sedans potentes. Oferece excelente aderência em piso seco e molhado, dirigibilidade precisa e durabilidade otimizada.',
                'especificacoes' => 'Marca: Michelin\nModelo: Pilot Sport 4S\nMedida: 255/35 R19\nÍndice de Carga: 96 (710 kg)\nÍndice de Velocidade: Y (300 km/h)\nTipo: Verão / Ultra High Performance',
                'preco' => 1100.00,
                'preco_promocional' => null,
                'imagem' => 'https://placehold.co/600x400/1a1a1a/FFF?text=Pneu+Michelin',
                'categoria' => 'Rodas e Pneus',
                'promocao' => false
            ]
        ];

        $produto_encontrado = null;
        foreach ($todos_produtos as $produto) {
            if ($produto['id'] === $id) {
                $produto_encontrado = $produto;
                break;
            }
        }

        if ($produto_encontrado) {
            $dados = [
                'titulo_pagina' => $produto_encontrado['nome'] . ' - Varejão Auto Peças',
                'produto' => $produto_encontrado
            ];
            $this->view('home/detalhes', $dados);
        } else {
             $dados = [
                'titulo_pagina' => 'Produto não encontrado',
                'mensagem_erro' => 'O produto que você está procurando não foi encontrado.'
            ];
             $this->view('erro/404', $dados);
        }
    }

    public function sobre() {
        $dados = [
            'titulo_pagina' => 'Sobre Nós - Varejão Auto Peças',
            'conteudo' => 'Informações sobre a empresa Varejão Auto Peças.'
        ];
        $this->view('home/sobre', $dados);
    }

    public function contato() {
        $dados = [
            'titulo_pagina' => 'Contato',
            'conteudo' => 'Entre em contato conosco para dúvidas ou sugestões.'
        ];
        $this->view('home/contato', $dados);
    }

}
?>
