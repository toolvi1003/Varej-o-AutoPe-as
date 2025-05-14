<?php


$produtos_promocao = $produtos_promocao ?? [];
$categorias = $categorias ?? [];
$produtos = $produtos ?? [];
?>


<?php if (!empty($produtos_promocao)):
?>
<section id="promocoes" class="mb-5">
    <h2 class="text-center mb-4 section-title">Produtos em Destaque</h2>
    <div id="carouselPromocoes" class="carousel slide">

        <div class="carousel-indicators">
            <?php foreach ($produtos_promocao as $indice => $produto):
 ?>
            <button type="button" data-bs-target="#carouselPromocoes" data-bs-slide-to="<?php echo $indice; ?>" class="<?php echo $indice == 0 ? 'active' : ''; ?>" aria-current="<?php echo $indice == 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $indice + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
        
        <div class="carousel-inner">
            <?php foreach ($produtos_promocao as $indice => $produto):
 ?>
            <div class="carousel-item <?php echo $indice == 0 ? 'active' : ''; ?>">
                <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" class="d-block w-100 carousel-img" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo htmlspecialchars($produto['nome']); ?></h5>
                    <p>
                        <?php if (!empty($produto['preco_promocional'])):
 ?>
                            <span class="text-decoration-line-through">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                            <strong class="text-danger">R$ <?php echo number_format($produto['preco_promocional'], 2, ',', '.'); ?></strong>
                        <?php else:
 ?>
                            <strong>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong>
                        <?php endif; ?>
                    </p>
                    <a href="<?php echo BASE_URL; ?>/produtos/detalhes/<?php echo $produto['id']; ?>" class="btn btn-danger">Ver Detalhes</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPromocoes" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselPromocoes" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
</section>
<?php endif; ?>


<?php if (!empty($categorias)):
 ?>
<section id="categorias-barra" class="py-3 mb-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-3 section-title--sub">Categorias</h3>
        <ul class="nav nav-pills justify-content-center my-4">
            <li class="nav-item">
                <a class="nav-link <?php echo (!isset($categoria_selecionada) || empty($categoria_selecionada)) ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>#produtos-grid">Ver Todas</a>
            </li>
            <?php foreach ($categorias as $categoria): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == $categoria) ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>?categoria=<?php echo urlencode($categoria); ?>#produtos-grid"><?php echo htmlspecialchars($categoria); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>


<section id="produtos-grid" class="mb-5">
    <h2 class="text-center section-title mt-5">
    <?php 
    if (isset($categoria_selecionada) && !empty($categoria_selecionada)) {
        echo 'Produtos em ' . htmlspecialchars($categoria_selecionada);
    } else {
        echo 'Nossos Produtos';
    }
    ?>
</h2>
    <?php if (!empty($produtos)):
 ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($produtos as $produto):
 ?>
        <div class="col">
            <div class="card h-100 product-card">
                <a href="<?php echo BASE_URL; ?>home/detalhes/<?php echo $produto['id']; ?>" class="text-decoration-none">
                    <?php if (!empty($produto['promocao'])): ?>
                        <span class="badge bg-danger position-absolute top-0 end-0 m-2" style="z-index: 1;">Promoção!</span>
                    <?php endif; ?>
                    <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" class="card-img-top product-card-img" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                </a>
                <div class="card-body d-flex flex-column">
                     <a href="<?php echo BASE_URL; ?>home/detalhes/<?php echo $produto['id']; ?>" class="text-decoration-none text-dark">
                        <h5 class="card-title flex-grow-1 product-card-title"><?php echo htmlspecialchars($produto['nome']); ?></h5>
                     </a>
                    <p class="card-text small"><?php echo htmlspecialchars($produto['descricao_curta']); ?></p>

                    <div class="mt-auto">
                        <?php if (!empty($produto['preco_promocional'])): ?>
                            <p class="price mb-0">
                                <small class="text-muted text-decoration-line-through">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></small><br>
                                <span class="price-promo">R$ <?php echo number_format($produto['preco_promocional'], 2, ',', '.'); ?></span>
                            </p>
                        <?php else: ?>
                            <p class="price mb-0">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo BASE_URL; ?>home/detalhes/<?php echo $produto['id']; ?>" class="btn btn-primary btn-sm mt-2 w-100">Ver Detalhes</a>
                        <form action="<?php echo BASE_URL; ?>/carrinho/adicionar" method="POST" class="mt-2">
                            <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                            <input type="hidden" name="quantidade" value="1">
                            <button type="submit" class="btn btn-success btn-sm w-100"><i class="fas fa-cart-plus"></i> Add Carrinho</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else:
 ?>
    <p class="text-center">Nenhum produto encontrado no momento.</p>
    <?php endif; ?>
</section>