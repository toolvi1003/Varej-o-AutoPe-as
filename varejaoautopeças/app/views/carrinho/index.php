
<div class="container mt-5 pagina-carrinho">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h2 class="mb-4 text-center display-5"><?php echo htmlspecialchars($titulo_pagina); ?></h2>

            <?php if (empty($itens_carrinho)): ?>
                <div class="alert alert-info text-center" role="alert">
                    <h4 class="alert-heading"><i class="fas fa-shopping-cart"></i> Seu carrinho está vazio!</h4>
                    <p>Que tal adicionar alguns produtos? Navegue pela nossa <a href="<?php echo BASE_URL; ?>/produtos" class="alert-link">loja de produtos</a>.</p>
                </div>
            <?php else: ?>
                <form action="<?php echo BASE_URL; ?>/carrinho/atualizar" method="POST"> 
                    <table class="table table-striped shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">Produto</th>
                                <th scope="col">Nome</th>
                                <th scope="col" class="text-end">Preço Unit.</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col" class="text-end">Subtotal</th>
                                <th scope="col" class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itens_carrinho as $item): ?>
                                <?php $preco_unit_formatado = 'R$ ' . number_format($item['preco'], 2, ',', '.'); ?>
                                <?php $subtotal_formatado = 'R$ ' . number_format($item['subtotal'], 2, ',', '.'); ?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <a href="<?php echo BASE_URL; ?>/produtos/detalhes/<?php echo $item['id']; ?>">
                                            <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>" class="img-fluid rounded" style="max-width: 80px; max-height: 80px;">
                                        </a>
                                    </td>
                                    <td class="align-middle"><a href="<?php echo BASE_URL; ?>/produtos/detalhes/<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['nome']); ?></a></td>
                                    <td class="text-end align-middle"><?php echo $preco_unit_formatado; ?></td>
                                    <td class="text-center align-middle">
                                        <input type="hidden" name="produto_id[]" value="<?php echo $item['id']; ?>">
                                        <input type="number" name="quantidade[]" value="<?php echo $item['quantidade']; ?>" min="1" max="99" class="form-control form-control-sm text-center" style="width: 70px; margin: auto;">
                                    </td>
                                    <td class="text-end align-middle fw-bold"><?php echo $subtotal_formatado; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="<?php echo BASE_URL; ?>/carrinho/remover/<?php echo $item['id']; ?>" class="btn btn-outline-danger btn-sm" title="Remover item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <td colspan="4" class="text-end fw-bold fs-5">TOTAL DO CARRINHO:</td>
                                <td class="text-end fw-bold fs-4 text-success"><?php echo 'R$ ' . number_format($total_carrinho, 2, ',', '.'); ?></td>
                                <td class="text-center">
                                    <button type="submit" class="btn btn-info btn-sm" title="Atualizar quantidades de todos os itens">
                                        <i class="fas fa-sync-alt"></i> Atualizar
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>

                <div class="row mt-4">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <a href="<?php echo BASE_URL; ?>/produtos" class="btn btn-outline-secondary w-100"><i class="fas fa-arrow-left"></i> Continuar Comprando</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn btn-success w-100 btn-lg"><i class="fas fa-check-circle"></i> Finalizar Compra</a> 
                    </div>
                </div>
                 <div class="text-center mt-3">
                    <a href="<?php echo BASE_URL; ?>/carrinho/limpar" class="btn btn-link text-danger btn-sm">Esvaziar Carrinho</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.pagina-carrinho .table th, .pagina-carrinho .table td {
    vertical-align: middle;
}
.pagina-carrinho .table img {
    object-fit: cover; 
}
.pagina-carrinho .alert-heading i {
    margin-right: 10px;
}
.pagina-carrinho .btn i {
    margin-right: 5px;
}
</style>
