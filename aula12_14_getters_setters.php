<?php

class Post
{
    private $titulo;
    private $data;
    private $corpo;
    private $comentarios;
    private $qtComentarios;
    
    // Aula 13
    public function __construct($titulo) {
        $this->setTitulo($titulo);
    }
    
    // Aula 12
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        if (is_string($titulo)) {
            $this->titulo = $titulo;
        }
    }
    public function getCorpo()
    {
        return $this-corpo;
    }
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
    }
    
    // Aula 14 - Metodos Auxiliares
    public function addComentario($msg)
    {
        // Adiciona no fim do array
        $this->comentarios[] = $msg;
        $this->contarComentarios();
    }
    public function getNumeroComentarios()
    {
        return $this->qtComentarios;
    }
    
    private function contarComentarios()
    {
        $this->qtComentarios = count($this->comentarios);
    }

}

$post = new Post("Titulo da Postagem");
$post->addComentario("Comentario 1");
$post->addComentario("Comentario 2");
$post->addComentario("Comentario 3");
$post->addComentario("Comentario 4");

echo "Titulo: ".$post->getTitulo()."<br>";
echo "Total comentarios: ".$post->getNumeroComentarios()."<br>";
?>