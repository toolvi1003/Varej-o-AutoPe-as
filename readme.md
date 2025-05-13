# Varejão Autopeças - Sua Loja Online de Autopeças

E aí! Este é o projeto da Varejão Autopeças, uma plataforma de e-commerce pra vender peças de carro.
Tô fazendo ele em PHP, com uma estrutura tipo MVC pra organizar as coisas.

## O que já tem (ou vai ter em breve):

*   Catálogo de produtos pra galera ver as peças.
*   Navegação por categorias de peças.
*   Uma arquitetura base com Router, Controllers, Models, etc.
*   (Em breve) Cadastro de clientes.
*   (Em breve) Carrinho de compras.
*   (Em breve) Um painel de admin pra gerenciar os produtos e categorias.

## Tecnologias que tô usando:

*   **Linguagem:** PHP (coloque sua versão aqui, ex: PHP 8.1)
*   **Servidor Web:** Apache (geralmente via XAMPP)
*   **Banco de Dados:** MySQL
*   **Frontend:** HTML5, CSS3 (e talvez um pouco de JavaScript mais pra frente)
*   **Controle de Versão:** Git

## Como rodar esse projeto na sua máquina:

1.  **Coisas que você precisa ter instaladas:**
    *   XAMPP (ou um ambiente similar com Apache, MySQL e PHP).
    *   Git (pra clonar o projeto, se for pegar do GitHub).
    *   Um editor de código da sua preferência (tipo VS Code, Sublime Text, etc.).

2.  **Baixando o projeto:**
    *   **Opção A: Se for clonar do GitHub (depois que você subir):**
        Abra o terminal ou prompt de comando e use:
        ```bash
        git clone [URL_DO_SEU_REPOSITORIO_NO_GITHUB_AQUI]
        cd nome_da_pasta_do_projeto_clonado 
        ```
    *   **Opção B: Se os arquivos já estão na sua máquina:**
        Certifique-se que eles estão na pasta correta dentro do seu `htdocs` (ex: `c:\xampp\htdocs\xampp\`).

3.  **Configurando o Banco de Dados:**
    *   No seu XAMPP, inicie o Apache e o MySQL.
    *   Acesse o phpMyAdmin (normalmente em `http://localhost/phpmyadmin`).
    *   Crie um novo banco de dados. O nome do banco deve ser o mesmo que está configurado em `DB_NAME` no seu arquivo `config.php` (provavelmente `varejao_db` ou algo assim).
    *   Importe o arquivo SQL que contém a estrutura das tabelas. Ele está em `c:\xampp\htdocs\xampp\varejaoautopeças\data\tabelas.sql`.
    *   Verifique o arquivo `config.php` (geralmente em `c:\xampp\htdocs\xampp\config\config.php` ou `c:\xampp\htdocs\xampp\varejaoautopeças\config\config.php` - ajuste o caminho se for diferente) e confira se as constantes `DB_HOST`, `DB_USER`, `DB_PASS`, e `DB_NAME` estão corretas para o seu ambiente XAMPP.

4.  **Configurando o Servidor Web (Apache e `.htaccess`):
    *   Certifique-se que o módulo `mod_rewrite` do Apache está ativado. No XAMPP, ele geralmente já vem ativado.
    *   O arquivo `.htaccess` importante está em `c:\xampp\htdocs\xampp\varejaoautopeças\publico\htaccess`.
    *   A diretiva `RewriteBase` dentro desse `.htaccess` precisa ser ajustada:
        *   Se você acessa seu projeto pela URL `http://localhost/xampp/varejaoautopeças/publico/`, então o `RewriteBase` deve ser `/xampp/varejaoautopeças/publico/`.
        *   Se você configurou um Virtual Host no Apache (ex: `http://varejao.local/` apontando para `c:\xampp\htdocs\xampp\varejaoautopeças\publico`), então o `RewriteBase` deve ser `/`.
    *   Ajuste a constante `BASE_URL` no seu arquivo `config.php` para ser a URL completa da pasta `publico` (ex: `define('BASE_URL', 'http://localhost/xampp/varejaoautopeças/publico/');`).

5.  **Acessando o projeto:**
    *   Abra o seu navegador e acesse a `BASE_URL` que você configurou no passo anterior.

## Como usar:

No momento, o projeto permite visualizar o catálogo de produtos (se já estiverem cadastrados e a lógica implementada) e a estrutura básica da aplicação. As funcionalidades de cadastro de usuário, login, carrinho de compras e o painel administrativo ainda estão em desenvolvimento ou precisam ser implementadas.

---
*Se tiver alguma dúvida ou sugestão, pode falar! E não esquece de preencher os [colchetes] com as suas informações quando for subir pro GitHub!*
