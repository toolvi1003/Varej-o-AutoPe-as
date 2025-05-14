<?php

?>

<div class="container mt-4 pagina-produtos">
    <h2 class="mb-4 section-title text-center"><?php echo htmlspecialchars($titulo_pagina ?? 'Nossos Produtos'); ?></h2>

    <?php if (empty($produtos_por_categoria)):
        echo '<div class="alert alert-info text-center" role="alert">Nenhum produto encontrado no momento.</div>';
    else:
        
        foreach ($produtos_por_categoria as $categoria => $produtos):
    ?>
            <section class="categoria-secao mb-5">
                <h3 class="mb-3 categoria-titulo"><?php echo htmlspecialchars($categoria); ?></h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                    <?php
                    
                    foreach ($produtos as $produto):
                        
                        $preco_formatado = 'R$ ' . number_format($produto['preco'], 2, ',', '.');
                    ?>
                        <div class="col">
                            <div class="card h-100 product-card">
                                <a href="<?php echo BASE_URL; ?>/produtos/detalhes/<?php echo $produto['id']; ?>" class="product-card-link">
                                    <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" class="card-img-top product-card-img" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title product-title"><a href="<?php echo BASE_URL; ?>/produtos/detalhes/<?php echo $produto['id']; ?>"><?php echo htmlspecialchars($produto['nome']); ?></a></h5>
                                    <p class="card-text product-description flex-grow-1"><?php echo htmlspecialchars($produto['descricao_curta']); ?></p>
                                    <p class="card-text product-price fw-bold fs-5"><?php echo $preco_formatado; ?></p>
                                    <a href="<?php echo BASE_URL; ?>/produtos/detalhes/<?php echo $produto['id']; ?>" class="btn btn-primary btn-sm mt-auto align-self-start btn-detalhes">Ver Detalhes</a>
                                    <form action="<?php echo BASE_URL; ?>/carrinho/adicionar" method="POST" class="mt-2">
                                        <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                        <input type="hidden" name="quantidade" value="1">
                                        <button type="submit" class="btn btn-success btn-sm w-100"><i class="fas fa-cart-plus"></i> Add Carrinho</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div> 
            </section> 
        <?php endforeach; ?>
    <?php endif; ?>

</div> 

<?php

?>
<style>
.pagina-produtos .categoria-titulo {
    border-bottom: 2px solid #D73737; 
    padding-bottom: 0.5rem;
    display: inline-block;
    font-size: 1.75rem; 
}

.product-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border: 1px solid #dee2e6; 
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.product-card-img {
    height: 220px; 
    object-fit: cover; 
}

.product-card-link {
    display: block;
    background-color: #f8f9fa; 
}

.product-title a {
    color: #212529; 
    text-decoration: none;
    font-weight: 600;
}

.product-title a:hover {
    color: #D73737; 
}

.product-description {
    font-size: 0.9rem;
    color: #6c757d; 
}

.product-price {
    color: #198754; 
    margin-top: 0.5rem;
    margin-bottom: 1rem;
}

.btn-detalhes {
   background-color: #0d6efd; /* Azul padrão Bootstrap */
   border-color: #0d6efd;
   font-size: 0.875rem;
   padding: 0.375rem 0.75rem;
}

.btn-detalhes:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

</style>
