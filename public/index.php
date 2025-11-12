<?php 
session_start();

//Carrega o autoload do composer
require_once __DIR__ . '/../vendor/autoload.php';

//Sistema de rotas
//Pegando o caminho da URL:
$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

if ($path === '/' || $path === ''){
    $path = '/login';
}
//Debug
//echo "A rota é {$path}";

//Rotas do CRUD
switch($path) {
    case '/login':
        echo "<h1>Página de Login</h1>";
        break;
    case '/logout';
        echo "<h1>Página de Logout</h1>";
        break;
    case '/veiculos';
        echo "<h1>Página de Listar Veículos</h1>";
        break;
    case '/veiculos/criar';
        echo "<h1>Página de Criar Veículos</h1>";
        break;
    case '/veiculos/atualizar':
        echo "<h1>Página de Atualizar Veículos</h1>";
        break;
    case '/veiculos/deletar';
        echo "<h1>Página de Deletar Veículos</h1>";
        break;
    default:
        http_response_code(404);
        echo "<h1>Erro 404 - Página Não Encontrada!</h1>";
        break;
}