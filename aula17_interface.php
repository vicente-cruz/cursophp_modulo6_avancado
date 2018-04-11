<?php

// Semelhante a Templates...
interface Animal
{
    // Todos devem ser publicos
    public function andar();
}

class Cachorro implements Animal
{
    public function andar()
    {
        echo "Walking...<br>";
    }
}

$cachorro = new Cachorro();
$cachorro->andar();
?>