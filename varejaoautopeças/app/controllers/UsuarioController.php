<?php

namespace app\controllers;

use app\core\Controller;
use app\models\UsuarioModel;

class UsuarioController extends Controller {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function cadastro() {
        $dados = [
            'titulo' => 'Cadastro de Usuário',
            'erro_validacao' => $_SESSION['erro_validacao'] ?? null,
            'dados_form' => $_SESSION['dados_form'] ?? []
        ];
        unset($_SESSION['erro_validacao']);
        unset($_SESSION['dados_form']);

        $this->view('usuario/cadastro', $dados);
    }

    public function processarCadastro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $senha = trim(filter_input(INPUT_POST, 'senha'));
            $confirmaSenha = trim(filter_input(INPUT_POST, 'confirma_senha'));

            $erros = [];
            $dados_form = ['nome' => $nome, 'email' => $email];

            if (empty($nome)) {
                $erros['nome'] = "Nome é obrigatório.";
            }

            if (empty($email)) {
                $erros['email'] = "E-mail é obrigatório.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros['email'] = "E-mail inválido.";
            } else {
                if ($this->usuarioModel->findByEmail($email)) {
                    $erros['email'] = "Este e-mail já está cadastrado.";
                }
            }

            if (empty($senha)) {
                $erros['senha'] = "Senha é obrigatória.";
            } elseif (strlen($senha) < 6) {
                $erros['senha'] = "Senha deve ter pelo menos 6 caracteres.";
            }

            if ($senha !== $confirmaSenha) {
                $erros['confirma_senha'] = "As senhas não coincidem.";
            }

            if (empty($erros)) {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                if (!$senhaHash) {
                    $_SESSION['erro_validacao'] = ['geral' => 'Erro crítico no processamento da senha. Tente novamente.'];
                    $_SESSION['dados_form'] = $dados_form;
                    header("Location: " . BASE_URL . "usuario/cadastro");
                    exit();
                }

                if ($this->usuarioModel->create($nome, $email, $senhaHash)) {
                    $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso! Faça o login.";
                    header("Location: " . BASE_URL . "usuario/login");
                    exit();
                } else {
                    $_SESSION['erro_validacao'] = ['geral' => 'Erro ao cadastrar usuário. Tente novamente.'];
                    $_SESSION['dados_form'] = $dados_form;
                    header("Location: " . BASE_URL . "usuario/cadastro");
                    exit();
                }
            } else {
                $_SESSION['erro_validacao'] = $erros;
                $_SESSION['dados_form'] = $dados_form;
                header("Location: " . BASE_URL . "usuario/cadastro");
                exit();
            }
        } else {
            header("Location: " . BASE_URL . "usuario/cadastro");
            exit();
        }
    }

    public function login() {
        $dados = [
            'titulo' => 'Login',
            'mensagem_sucesso' => $_SESSION['mensagem_sucesso'] ?? null,
            'erro_login' => $_SESSION['erro_login'] ?? null,
            'email_login' => $_SESSION['email_login'] ?? ''
        ];

        unset($_SESSION['mensagem_sucesso']);
        unset($_SESSION['erro_login']);
        unset($_SESSION['email_login']);

        $this->view('usuario/login', $dados);
    }

    public function processarLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $senha = trim(filter_input(INPUT_POST, 'senha'));

            if (empty($email) || empty($senha)) {
                $_SESSION['erro_login'] = "E-mail e senha são obrigatórios.";
                $_SESSION['email_login'] = $email;
                header("Location: " . BASE_URL . "usuario/login");
                exit();
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 $_SESSION['erro_login'] = "Formato de e-mail inválido.";
                 $_SESSION['email_login'] = $email;
                 header("Location: " . BASE_URL . "usuario/login");
                 exit();
            }

            $usuario = $this->usuarioModel->findByEmail($email);

            if ($usuario && password_verify($senha, $usuario->senha)) {
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nome'] = $usuario->nome;
                $_SESSION['usuario_email'] = $usuario->email;

                header("Location: " . BASE_URL);
                exit();
            } else {
                $_SESSION['erro_login'] = "E-mail ou senha inválidos.";
                $_SESSION['email_login'] = $email;
                header("Location: " . BASE_URL . "usuario/login");
                exit();
            }
        } else {
            header("Location: " . BASE_URL . "usuario/login");
            exit();
        }
    }

    public function logout() {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        header("Location: " . BASE_URL . "usuario/login");
        exit();
    }
}
