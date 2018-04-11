<?php

class Calculadora
{
    private $n;
    
    public function __construct($inicial) {
        $this->n = $inicial;
    }
    
    public function somar($n1)
    {
        $this->n += $n1;
        // Retorna o proprio objeto: permite encadeamento de funcoes
        return $this;
    }
    public function subtrair($n1)
    {
        $this->n -= $n1;
        return $this;
    }
    public function multiplicar($n1)
    {
        $this->n *= $n1;
        return $this;
    }
    public function dividir($n1)
    {
        $this->n /= $n1;
        return $this;
    }
    
    public function resultado()
    {
        return $this->n;
    }
}

$calc = new Calculadora(10);

$calc->somar(2)->subtrair(3)->multiplicar(5)->dividir(2);
echo "Resultado Calculadora Recursiva: ".$calc->resultado();

//echo "2+10=".$calc->somar(2, 10)."<br>";
//echo "20-16=".$calc->subtrair(20, 16)."<br>";
//echo "9*2=".$calc->multiplicar(9, 2)."<br>";
//echo "12/2=".$calc->dividir(12, 2)."<br>";


?>