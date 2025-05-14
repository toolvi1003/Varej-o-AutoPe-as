<?php


$titulo = $titulo_pagina ?? 'Erro 404 - Página Não Encontrada';
$mensagem = $mensagem_erro ?? 'A página que você está tentando acessar não existe ou foi movida.';


?>

<div class="container mt-5 text-center">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h1 class="display-4"><?php echo htmlspecialchars($titulo); ?></h1>
                </div>
                <div class="card-body">
                    <p class="lead"><?php echo htmlspecialchars($mensagem); ?></p>
                    <p>Verifique se o endereço (URL) está correto ou tente voltar para a página inicial.</p>
                    <a href="<?php echo BASE_URL; ?>" class="btn btn-primary mt-3">Voltar para a Página Inicial</a>
                </div>
                <div class="card-footer text-muted">
                    Se o problema persistir, entre em contato com o suporte.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
    .card-header h1 {
        font-size: 2.5rem;
    }
</style>
