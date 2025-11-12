<?php
namespace Config;

use \PDO;
use \PDOException;

class Database{
    private static $db_path = __DIR__ . '/../db/gestao_veiculos.sqlite';
    private static $connection = null; //guarda a conexão

    public static function getConnection(){
        //Se não tiver conexão, cria uma
        if (self::$connection === null){
            try{
                //$dsn = Data Source Name (nome do bd)
                $dsn = 'sqlite:' . self::$db_path;
                self::$connection = new PDO($dsn);

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                
            } catch (PDOException $e){
                die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }

}