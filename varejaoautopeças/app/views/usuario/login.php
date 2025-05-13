<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?php echo htmlspecialchars($titulo ?? 'Login'); ?></h4>
                </div>
                <div class="card-body">

                    <?php
                    
                    if (isset($mensagem_sucesso)) {
                        echo '<div class="alert alert-success">' . htmlspecialchars($mensagem_sucesso) . '</div>';
                    }
                    
                    if (isset($erro_login)) {
                        echo '<div class="alert alert-danger">' . htmlspecialchars($erro_login) . '</div>';
                    }
                    ?>

                    <form action="<?php echo BASE_URL; ?>usuario/processarLogin" method="POST" novalidate>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Endereço de E-mail</label>
                            <input type="email"
                                   class="form-control <?php echo isset($erro_login) ? 'is-invalid' : ''; ?>"
                                   id="email"
                                   name="email"
                                   value="<?php echo htmlspecialchars($email_login ?? ''); ?>"
                                   required>
                        </div>

                        
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password"
                                   class="form-control <?php echo isset($erro_login) ? 'is-invalid' : ''; ?>"
                                   id="senha"
                                   name="senha"
                                   required>
                            <?php if (isset($erro_login)): ?>
                            <?php endif; ?>
                        </div>

                         
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg">Entrar</button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        Não tem uma conta? <a href="<?php echo BASE_URL; ?>usuario/cadastro">Cadastre-se</a>
                    </div>

                </div> 
            </div> 
        </div> 
    </div> 
</div> 
