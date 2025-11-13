<?php
namespace App\Helpers;

class Utils
{
    /**
     * Exibe um alerta Javascript e volta para a página anterior.
     * Interrompe a execução do script imediatamente.
     */
    public static function alertAndBack($mensagem)
    {
        echo "<script>
            alert('$mensagem');
            history.back();
        </script>";
        exit;
    }
}