<?php 
namespace App\DAO;

use Config\Database;
use App\Models\Usuario;
use \PDO;
use PDOException;

class UsuarioDAO{
    private $db; //guardar a conexão.

    public function __construct(){
        $this->db = Database::getConnection();
    }

    //Insere novo usuario no BD
    public function create(Usuario $usuario){
        try{
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            $senha = $usuario->getSenha();

            $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);

            return $stmt->execute();
        } catch (PDOException $e) {
            die('Erro ao criar usuário ' . $e->getMessage());
        }
    }
    //Buscar um usuário pelo email
    public function findByEmail($email){
        try {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data){
            $usuario = new Usuario();
            $usuario->setId($data['id']);
            $usuario->setNome($data['nome']);
            $usuario->setEmail($data['email']);
            $usuario->setSenha($data['senha']);
            return $usuario;
        }
        return null;
        } catch (PDOException $e) {
            die('Erro ao buscar o usuário: ' . $e->getMessage());
        }
    }
}