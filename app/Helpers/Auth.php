<?php 
namespace App\Helpers;

/**
 * Verifica se o usuário esta logado (se a sessao esta existindo)
 * caso não esteja, redireciona para o login e morre.
 */
class Auth {
    public static function check(){
        if(!isset($_SESSION['usuario_id'])){
            header('Location: /login');
            exit;
        }
    }
}