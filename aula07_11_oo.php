<?php
//Aula 7 - Introdução OO
//Aula 8 - Explicação Classe
//Aula 9 - Explicação Método
//Aula 10 - Instanciando Classes
class Cachorro {
    //Aula 11 - Propriedades ou Atributos
    private $nome;
    private $idade;
    
    public function latir($latido)
    {
        echo $latido."<br>";
    }
}

// Aula 10 - Instanciando Cachorro
$dog = new Cachorro();
$dog->latir("Au au");
// Somente para metodos publicos
Cachorro::latir("Grrr");

?>