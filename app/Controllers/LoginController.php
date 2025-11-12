<?php
namespace App\Controllers;

use App\DAO\UsuarioDAO;
use App\Models\Usuario;

class LoginController {

    //Chama a view
    public function index(){
        require_once __DIR__ . '/../Views/login.php';
    }
    public function showRegisterPage(){
        require_once __DIR__ . '/../Views/register.php';
    }

    //Autentica o usuário
    public function auth(){
        $email = $_POST['email'];
        $senha_formulario = $_POST['senha'];

        $dao = new UsuarioDAO();
        $usuario = $dao->findByEmail($email);

        if ($usuario && password_verify($senha_formulario, $usuario->getSenha())) {
            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['usuario_nome'] = $usuario->getNome();

            header('Location: /veiculos');
            exit;
        } else {
            echo "Login falhou. Email ou senha incorretos!";
        }
    }

    public function processRegister(){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha_hash);

        $dao = new UsuarioDAO();
        $sucesso = $dao->create($usuario);

        if ($sucesso) {
            header('Location: /login');
            exit;
        }else {
            echo "Erro ao cadastrar!";
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}