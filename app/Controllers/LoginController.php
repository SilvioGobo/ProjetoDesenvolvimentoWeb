<?php
namespace App\Controllers;

use App\DAO\UsuarioDAO;
use App\Models\Usuario;
use App\Helpers\Utils;

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
        // Validação de segurança do email
        // Verifica Nome
        if (empty($_POST['nome']) || trim($_POST['nome']) === '') {
            Utils::alertAndBack("Erro: O Nome é obrigatório!");
        }
        // Verifica Email (Vazio)
        if (empty($_POST['email']) || trim($_POST['email']) === '') {
            Utils::alertAndBack("Erro: O Email é obrigatório!");
        }
        // Verifica Email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Utils::alertAndBack("Erro: O formato do Email é inválido!");
        }
        // Verifica Senha
        if (empty($_POST['senha'])) {
            Utils::alertAndBack("Erro: A Senha é obrigatória!");
        }
        // Verifica Senha
        if (strlen($_POST['senha']) < 6) {
            Utils::alertAndBack("Erro: A senha deve ter pelo menos 6 caracteres!");
        }

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha_hash);

        $dao = new UsuarioDAO();
        try {
            // Tenta criar. Se o email já existir, o DAO vai jogar um erro
            $dao->create($usuario);
            echo "<script>
                alert('Cadastro realizado com sucesso! Faça o login.');
                window.location.href = '/login';
            </script>";
            exit;

        } catch (\Exception $e) {
            // Aqui pegamos o erro do banco (ex: email duplicado)
            
            // O código 23000 geralmente é violação de unicidade (duplicate entry)
            if ($e->getCode() == '23000') {
                 Utils::alertAndBack("Erro: Este email já está cadastrado!");
            } else {
                 Utils::alertAndBack("Erro ao cadastrar: " . $e->getMessage());
            }
        }

    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}