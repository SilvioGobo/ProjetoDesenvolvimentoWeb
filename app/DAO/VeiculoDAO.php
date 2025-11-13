<?php 
namespace App\DAO;

use Config\Database;
use App\Models\Veiculo;
use \PDO;
use PDOException;

class VeiculoDAO{
    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function getAll(){
        try{
            $sql = "SELECT * FROM veiculos";
            $stmt = $this->db->query($sql);

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $veiculos = []; //guarda os objetos

            foreach($dados as $linha){
                $v = new Veiculo();
                $v->setId($linha['id']);
                $v->setMarca($linha['marca']);
                $v->setModelo($linha['modelo']);
                $v->setAno($linha['ano']);
                $v->setCondicao($linha['condicao']);
                $v->setKm($linha['km']);

                $veiculos[] = $v;
            }
            return $veiculos;
        } catch (PDOException $e){
            die('Erro ao buscar veículos: ' . $e->getMessage());
        }
    }
    public function create(Veiculo $veiculo) {
        try{
            $marca = $veiculo->getMarca();
            $modelo = $veiculo->getModelo();
            $ano = $veiculo->getAno();
            $condicao = $veiculo->getCondicao();
            $km = $veiculo->getKm();

            $stmt = $this->db->prepare("INSERT INTO veiculos (marca, modelo, ano, condicao, km) VALUES (:marca, :modelo, :ano, :condicao, :km)");

            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':condicao', $condicao);
            $stmt->bindParam(':km', $km);

            return $stmt->execute();
        }catch (PDOException $e){
            die('Não foi possível cadastrar o veículo: ' . $e->getMessage());
        }
    }
    public function delete($id){
        try{
            $sql = "DELETE FROM veiculos WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        }catch(PDOException $e){
            die('Erro ao excluir o Veículo: ' . $e->getMessage());
        }
    }

    //Fazendo o UPDATE do veiculo:
    public function getById($id){
        try{
            $sql = "SELECT * FROM veiculos WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $linha = $stmt->fetch(PDO::FETCH_ASSOC);

            if($linha){
                $v = new Veiculo();
                $v->setId($linha['id']);
                $v->setMarca($linha['marca']);
                $v->setModelo($linha['modelo']);
                $v->setAno($linha['ano']);
                $v->setCondicao($linha['condicao']);
                $v->setKm($linha['km']);
                return $v;
            }
            return null;
        } catch (PDOException $e) {
            die('Erro ao Buscar o Veículo: ' . $e->getMessage());
        }
    }
    
    public function update(Veiculo $veiculo){
        try{
            $sql = "UPDATE veiculos SET
            marca = :marca,
            modelo = :modelo,
            ano = :ano,
            condicao = :condicao,
            km = :km
            WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $id = $veiculo->getId();
            $marca = $veiculo->getMarca();
            $modelo = $veiculo->getModelo();
            $ano = $veiculo->getAno();
            $condicao = $veiculo->getCondicao();
            $km = $veiculo->getKm();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':condicao', $condicao);
            $stmt->bindParam(':km', $km);

            return $stmt->execute();
        }catch(PDOException $e){
            die('Erro ao atualizar o veículo' . $e->getMessage());
        }
    }
}