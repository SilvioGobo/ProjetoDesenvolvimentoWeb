<?php 
session_start();

//Carrega o autoload do composer
require_once __DIR__ . '/../vendor/autoload.php';

//Sistema de rotas
//Pegando o caminho da URL:
$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
use App\Helpers\Auth;

if ($path === '/' || $path === ''){
    $path = '/login';
}
//Debug
//echo "A rota é {$path}";

//Rotas do CRUD e Login
switch($path) {
    case '/login':
        //echo "<h1>Página de Login</h1>";
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            (new App\Controllers\LoginController())->index();
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            (new App\Controllers\LoginController())->auth();
        }
        break;
    case '/register';
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            (new App\Controllers\LoginController())->showRegisterPage();
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            (new App\Controllers\LoginController())->ProcessRegister();
        }
        break;
    case '/logout';
        //echo "<h1>Página de Logout</h1>";
        Auth::check();
        (new App\Controllers\LoginController())->logout();
        break;

        //CRUD do veiculo
    case '/veiculos';
        echo "<h1>Página de Listar Veículos</h1>";
        Auth::check();
        break;
    case '/veiculos/criar';
        echo "<h1>Página de Criar Veículos</h1>";
        Auth::check();
        break;
    case '/veiculos/atualizar':
        echo "<h1>Página de Atualizar Veículos</h1>";
        Auth::check();
        break;
    case '/veiculos/deletar';
        echo "<h1>Página de Deletar Veículos</h1>";
        Auth::check();
        break;
    default:
        http_response_code(404);
        echo "<h1>Erro 404 - Página Não Encontrada!</h1>";
        break;
}