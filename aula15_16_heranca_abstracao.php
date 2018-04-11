<?php

abstract class Animal
{
    private $nome;
    private $idade;
    
    abstract protected function andar();
    
    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
}

class Cavalo extends Animal
{
    private $raca;
    private $tipo_pelo;
    
    public function andar()
    {
        
    }
}

$cavalo = new Cavalo();
$cavalo->setNome("Gold");

echo "Nome do cavalo: ".$cavalo->getNome()."<br>";
?>