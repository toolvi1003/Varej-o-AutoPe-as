<?php



$preco_formatado = 'R$ ' . number_format($produto['preco'], 2, ',', '.');
?>

<div class="container mt-5 pagina-detalhes-produto">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h2 class="mb-0"><?php echo htmlspecialchars($produto['nome']); ?></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 mb-3 mb-md-0 text-center">
                            <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" class="img-fluid rounded product-image-detail" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        </div>
                        <div class="col-md-7">
                            <h4 class="text-muted">Categoria: <?php echo htmlspecialchars($produto['categoria']); ?></h4>
                            <p class="lead mt-3 product-description-long">
                                <?php echo nl2br(htmlspecialchars($produto['descricao_longa'] ?? $produto['descricao_curta'])); ?>
                            </p>
                            <hr>
                            <h3 class="product-price-detail fw-bold my-3"><?php echo $preco_formatado; ?></h3>
                            
                            <form action="<?php echo BASE_URL; ?>/carrinho/adicionar" method="POST" class="d-inline-block me-2">
                                <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                <div class="input-group" style="max-width: 250px;">
                                    <input type="number" name="quantidade" class="form-control form-control-lg text-center" value="1" min="1" max="99" aria-label="Quantidade">
                                    <button class="btn btn-success btn-lg" type="submit"><i class="fas fa-cart-plus"></i> Add Carrinho</button>
                                </div>
                            </form>
                            
                            <div class="mt-4 product-meta">
                                <p><small><strong>Código do Produto:</strong> #<?php echo htmlspecialchars($produto['id']); ?></small></p>
                                <p><small><em>Disponibilidade: Em estoque (simulado)</em></small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="<?php echo BASE_URL; ?>/produtos" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i> Voltar para Produtos</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pagina-detalhes-produto .product-image-detail {
    max-height: 400px; 
    border: 1px solid #ddd;
    padding: 5px;
}

.pagina-detalhes-produto .product-description-long {
    font-size: 1.1rem;
    line-height: 1.6;
}

.pagina-detalhes-produto .product-price-detail {
    color: #198754; 
}

.pagina-detalhes-produto .card-header h2 {
    font-size: 1.8rem;
}

.pagina-detalhes-produto .btn-lg i {
    margin-right: 8px;
}

@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"); 
</style>

