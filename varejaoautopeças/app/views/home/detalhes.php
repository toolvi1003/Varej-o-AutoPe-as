<?php

if (!isset($produto) || empty($produto)) {
    echo '<div class="container mt-5"><div class="alert alert-danger">Produto não encontrado.</div></div>';
    return;
}


$preco_final = $produto['preco_promocional'] ?? $produto['preco'];
$preco_antigo = ($produto['preco_promocional']) ? $produto['preco'] : null;

$preco_formatado = 'R$ ' . number_format($preco_final, 2, ',', '.');
$preco_antigo_formatado = $preco_antigo ? 'R$ ' . number_format($preco_antigo, 2, ',', '.') : null;


$especificacoes_formatadas = nl2br(htmlspecialchars($produto['especificacoes']));

?>

<div class="container mt-5 mb-5">
    <div class="row">
        
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="img-fluid rounded border">
             <?php if ($produto['promocao']): ?>
                <span class="badge bg-danger position-absolute top-0 start-0 m-2" style="font-size: 1rem;">Promoção!</span>
            <?php endif; ?>
        </div>

        
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Início</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>?categoria=<?php echo urlencode($produto['categoria']); ?>#produtos-grid"><?php echo htmlspecialchars($produto['categoria']); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($produto['nome']); ?></li>
                </ol>
            </nav>

            <h1 class="mb-3"><?php echo htmlspecialchars($produto['nome']); ?></h1>

            <div class="mb-4">
                <?php if ($preco_antigo_formatado): ?>
                    <span class="text-muted text-decoration-line-through me-2"><?php echo $preco_antigo_formatado; ?></span>
                    <span class="h3 price-promo"><?php echo $preco_formatado; ?></span>
                <?php else: ?>
                    <span class="h3 price"><?php echo $preco_formatado; ?></span>
                <?php endif; ?>
                <small class="text-muted d-block">Em até 10x sem juros (simulação)</small>
            </div>

             <div class="d-grid gap-2 mb-4">
                 <button class="btn btn-success btn-lg" type="button">
                     <i class="fas fa-shopping-cart me-2"></i> Adicionar ao Carrinho
                 </button>
                  <button class="btn btn-outline-secondary" type="button">
                     <i class="fas fa-heart me-2"></i> Adicionar à Lista de Desejos
                 </button>
             </div>


            <h5 class="mt-4">Descrição</h5>
            <p><?php echo htmlspecialchars($produto['descricao_longa']); ?></p>

            <h5 class="mt-4">Especificações Técnicas</h5>
            <?php
            $specs_lines = explode("\\n", $produto['especificacoes']);
            if (!empty($specs_lines) && !(count($specs_lines) === 1 && trim($specs_lines[0]) === '')) :
            ?>
                <ul class="list-unstyled specifications-list mt-3">
                    <?php foreach ($specs_lines as $line) :
                        $parts = explode(':', $line, 2);
                        $key = trim($parts[0] ?? '');
                        $value = trim($parts[1] ?? '');
                        if (!empty($key)) :
                    ?>
                            <li class="mb-2">
                                <strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?>
                            </li>
                    <?php
                        endif;
                    endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Nenhuma especificação disponível.</p>
            <?php endif; ?>

        </div>
    </div>
</div>


<style>
.price-promo { color: #D73737; font-weight: 700; }
.price { color: #333; font-weight: 700; }
.specifications {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    white-space: pre-line;
    font-family: monospace;
    line-height: 1.7;
}
.specifications-list li {
    padding: 5px 0;
    border-bottom: 1px solid #eee;
}
.specifications-list li:last-child {
    border-bottom: none;
}
.breadcrumb a {
    color: #D73737;
}
.breadcrumb a:hover {
    color: #A72121;
}

@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css");

</style>
