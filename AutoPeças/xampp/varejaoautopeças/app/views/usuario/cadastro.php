<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?php echo htmlspecialchars($titulo ?? 'Cadastro'); ?></h4>
                </div>
                <div class="card-body">

                    <?php
                    
                    if (isset($erro_validacao['geral'])) {
                        echo '<div class="alert alert-danger">' . htmlspecialchars($erro_validacao['geral']) . '</div>';
                    }
                    ?>

                    <form action="<?php echo BASE_URL; ?>usuario/processarCadastro" method="POST" novalidate>

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text"
                                   class="form-control <?php echo isset($erro_validacao['nome']) ? 'is-invalid' : ''; ?>"
                                   id="nome"
                                   name="nome"
                                   value="<?php echo htmlspecialchars($dados_form['nome'] ?? ''); ?>"
                                   required>
                            <?php if (isset($erro_validacao['nome'])):
 ?>
                                <div class="invalid-feedback">
                                    <?php echo htmlspecialchars($erro_validacao['nome']); ?>
                                </div>
                            <?php endif;
 ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Endereço de E-mail</label>
                            <input type="email"
                                   class="form-control <?php echo isset($erro_validacao['email']) ? 'is-invalid' : ''; ?>"
                                   id="email"
                                   name="email"
                                   value="<?php echo htmlspecialchars($dados_form['email'] ?? ''); ?>"
                                   required>
                             <?php if (isset($erro_validacao['email'])):
 ?>
                                <div class="invalid-feedback">
                                    <?php echo htmlspecialchars($erro_validacao['email']); ?>
                                </div>
                            <?php endif;
 ?>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password"
                                   class="form-control <?php echo isset($erro_validacao['senha']) ? 'is-invalid' : ''; ?>"
                                   id="senha"
                                   name="senha"
                                   required>
                            <div class="form-text">Mínimo de 6 caracteres.</div>
                            <?php if (isset($erro_validacao['senha'])):
 ?>
                                <div class="invalid-feedback">
                                    <?php echo htmlspecialchars($erro_validacao['senha']); ?>
                                </div>
                            <?php endif;
 ?>
                        </div>

                        <div class="mb-3">
                            <label for="confirma_senha" class="form-label">Confirme sua Senha</label>
                            <input type="password"
                                   class="form-control <?php echo isset($erro_validacao['confirma_senha']) ? 'is-invalid' : ''; ?>"
                                   id="confirma_senha"
                                   name="confirma_senha"
                                   required>
                             <?php if (isset($erro_validacao['confirma_senha'])):
 ?>
                                <div class="invalid-feedback">
                                    <?php echo htmlspecialchars($erro_validacao['confirma_senha']); ?>
                                </div>
                            <?php endif;
 ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg">Criar Conta</button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        Já tem uma conta? <a href="<?php echo BASE_URL; ?>usuario/login">Faça Login</a>
                    </div>

                </div> 
            </div> 
        </div> 
    </div> 
</div> 
