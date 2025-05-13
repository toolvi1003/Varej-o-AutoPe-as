<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) : 'Varejão Auto Peças'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/estilo.css">
</head>
<body>
    <header>
    <div class="container">
        <h1><a href="<?php echo BASE_URL; ?>">Varejão Auto Peças</a></h1>
        <nav>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>">Início</a></li>
                <li><a href="<?php echo BASE_URL; ?>/home/sobre">Sobre</a></li>
                <li><a href="<?php echo BASE_URL; ?>/home/contato">Contato</a></li> 
                <li><a href="<?php echo BASE_URL; ?>/produtos">Produtos</a></li> 
                <li><a href="<?php echo BASE_URL; ?>/carrinho"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                 <?php
                 if (session_status() == PHP_SESSION_NONE) {
                     session_start();
                 }

                 if (isset($_SESSION['usuario_id'])):
 ?>
                    <li><span>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</span></li>
                    <li><a href="<?php echo BASE_URL; ?>usuario/logout">Sair</a></li>
                 <?php else:
 ?>
                    <li><a href="<?php echo BASE_URL; ?>usuario/cadastro">Cadastre-se</a></li>
                    <li><a href="<?php echo BASE_URL; ?>usuario/login">Login</a></li>
                 <?php endif;
 ?>
            </ul>
        </nav>
    </div>
</header>

    <main class="container">
        <?php

        if (isset($view_content_for_layout) && file_exists($view_content_for_layout)) {
            include $view_content_for_layout;
        } else {
            echo "<p>Erro: Conteúdo da view não pôde ser carregado.</p>";
            if (isset($view_content_for_layout)) {
                error_log("Layout: Arquivo de view não encontrado: " . $view_content_for_layout);
            } else {
                error_log("Layout: Variável \$view_content_for_layout não definida.");
            }
        }
        ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Varejão Auto Peças. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/js/scripts.js"></script>
</body>
</html>
