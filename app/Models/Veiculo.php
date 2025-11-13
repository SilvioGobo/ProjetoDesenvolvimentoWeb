<?php 
namespace App\Models;

class Veiculo{
    private $id;
    private $marca;
    private $modelo;
    private $ano;
    private $condicao;
    private $km;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getMarca(){
        return $this->marca;
    }
    public function setMarca($marca){
        $this->marca = $marca;
    }
    public function getModelo(){
        return $this->modelo;
    }
    public function setModelo($modelo){
        $this->modelo = $modelo;
    }
    public function getAno(){
        return $this->ano;
    }
    public function setAno($ano){
        $this->ano = $ano;
    }
    public function getCondicao(){
        return $this->condicao;
    }
    public function setCondicao($condicao){
        $this->condicao = $condicao;
    }
    public function getKm(){
        return $this->km;
    }
    public function setKm($km){
        $this->km = $km;
    }
}