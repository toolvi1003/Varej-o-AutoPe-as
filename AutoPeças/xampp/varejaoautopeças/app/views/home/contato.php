<?php

?>

<section class="pagina-contato container mt-4">
    <h2><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) : 'Fale Conosco'; ?></h2>
    <p><?php echo isset($conteudo) ? nl2br(htmlspecialchars($conteudo)) : 'Tem alguma dúvida, sugestão ou precisa de ajuda? Entre em contato conosco!'; ?></p>

    <div class="row">
        
        <div class="col-md-8 mb-4">
            <h3>Envie sua Mensagem</h3>
            <form action="<?php echo BASE_URL; ?>/home/enviarContato" method="POST">
                 <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Seu Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                 <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" class="form-control" id="assunto" name="assunto" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Sua Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Enviar Mensagem</button>
            </form>
        </div>

        
        <div class="col-md-4">
            <h3>Nossos Contatos</h3>
            <address>
                <strong>Varejão Auto Peças</strong><br>
                SIA Trecho 4, Lote 500 - Guará<br>
                Brasília, DF - 71200-040<br>
                <abbr title="Telefone">Tel:</abbr> (61) 3333-4444<br>
                <abbr title="WhatsApp">WhatsApp:</abbr> (61) 99999-8888
            </address>
            <p>
                <strong>Email:</strong><br>
                <a href="mailto:contato@varejaoautopecas.local">contato@varejaoautopecas.local</a>
            </p>
            <p>
                <strong>Horário de Atendimento:</strong><br>
                Segunda a Sexta: 8h às 18h<br>
                Sábado: 8h às 12h
            </p>
             
             
        </div>
    </div>
</section>
