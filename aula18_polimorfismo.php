<?php

class Animal
{
    public $nome;
    
    public function __construct($nome) {
        $this->setNome($nome);
    }

    public function getNome() {
        return "getNome do Animal: ".$this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
}

class Cachorro extends Animal
{
    public function getNome()
    {
        return "getNome do Cachorro: ".$this->nome;
    }
}

$cachorro = new Cachorro("Nome Animal");
echo $cachorro->getNome();
?>