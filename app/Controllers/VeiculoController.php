<?php 
namespace App\Controllers;

use App\DAO\VeiculoDAO;
use App\Models\Veiculo;
use App\Helpers\Utils;

class VeiculoController{
    public function index(){
        //Chama a dao para pegar os dados
        $dao = new VeiculoDAO();
        $veiculos = $dao->getAll();

        //carrega a view 
        require_once __DIR__ . '/../Views/veiculos/lista.php';
    }

    public function create(){
        require_once __DIR__ . '/../Views/veiculos/formulario.php';
    }

    public function store(){
        //Validação do servidor
        if (empty($_POST['marca']) || trim($_POST['marca']) === '') {
            Utils::alertAndBack("Erro: O campo MARCA é obrigatório!");
        }

        if (empty($_POST['modelo']) || trim($_POST['modelo']) === '') {
            Utils::alertAndBack("Erro: O campo MODELO é obrigatório!");
        }

        if (empty($_POST['ano']) || !is_numeric($_POST['ano'])) {
            Utils::alertAndBack("Erro: O campo ANO deve ser um número válido!");
        }

        if ($_POST['km'] === '' || !is_numeric($_POST['km'])) {
             Utils::alertAndBack("Erro: O KM deve ser um número válido!");
        }
        //pega os dados do post
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $km = $_POST['km'];
        $condicao = $_POST['condicao'];

        //preenche
        $veiculo = new Veiculo();
        $veiculo->setMarca($marca);
        $veiculo->setModelo($modelo);
        $veiculo->setAno($ano);
        $veiculo->setKm($km);
        $veiculo->setCondicao($condicao);

        //chama o DAO
        $dao = new VeiculoDAO();
        $sucesso = $dao->create($veiculo);

        //Redireciona
        if ($sucesso){
            header('Location: /veiculos');
            exit;
        }else{
            echo "Erro ao Salvar o Veículo!";
        }
    }
    
    public function delete(){
        if(!isset($_GET['id'])){
            header('Location: /veiculos');
            exit;
        }
        $id = $_GET['id'];
        //chama o DAO para deletar
        $dao = new VeiculoDAO();
        $dao->delete($id);
        //redireciona
        header('Location: /veiculos');
        exit;
    }

    //Controle do update
    public function edit(){
        if(!isset($_GET['id'])){
            header('Location: /veiculos');
            exit;
        }
        $id = $_GET['id'];

        $dao = new VeiculoDAO();
        $veiculo = $dao->getById($id); //busca dados antigos

        if(!$veiculo){
            echo "Veículo não encontrado!";
            exit;
        }
        require_once __DIR__ . '/../Views/veiculos/editar.php';
    }

    public function update(){
        //Validacoes
        
        // Verifica Marca
        if (empty($_POST['marca']) || trim($_POST['marca']) === '') {
            Utils::alertAndBack("Erro: A MARCA é obrigatória!");
        }

        // Verifica Modelo
        if (empty($_POST['modelo']) || trim($_POST['modelo']) === '') {
            Utils::alertAndBack("Erro: O MODELO é obrigatório!");
        }

        // Verifica Ano (Aqui que barramos o texto no lugar de número)
        if (empty($_POST['ano']) || !is_numeric($_POST['ano'])) {
            Utils::alertAndBack("Erro: O ANO deve ser um número válido!");
        }

        // Verifica KM (Aqui também barramos texto)
        // Aceitamos '0', mas não vazio ou texto
        if ($_POST['km'] === '' || !is_numeric($_POST['km'])) {
             Utils::alertAndBack("Erro: O KM deve ser um número válido!");
        }
        //Pega os dados do POST
        $id = $_POST['id'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $km = $_POST['km'];
        $condicao = $_POST['condicao'];

        $veiculo = new Veiculo();
        $veiculo->setId($id); // Importante setar o ID!
        $veiculo->setMarca($marca);
        $veiculo->setModelo($modelo);
        $veiculo->setAno($ano);
        $veiculo->setKm($km);
        $veiculo->setCondicao($condicao);

        $dao = new VeiculoDAO();
        $sucesso = $dao->update($veiculo);
        if ($sucesso) {
            header('Location: /veiculos');
            exit;
        } else {
            echo "Erro ao atualizar veículo.";
        }
    }
}