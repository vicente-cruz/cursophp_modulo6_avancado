<?php
// Aula 21 -> CRIAR CLASSE BANCO DE DADOS E CONEXAO
require "banco.php";
$banco = new Banco("localhost","curso_php","root","");

//// Aula 22 -> CRIAR QUERY EXECUTORA
//$banco->query("SELECT * FROM usuarios");
//echo "Numero Registros: ".$banco->numRows()."<br>";

// Aula 23 -> SELECT ou RESULT
$banco->query("SELECT * FROM usuarios");
if ($banco->numRows() > 0) {
    foreach ($banco->result() as $usuario) {
        echo "ID: ".$usuario['id']."<br>";
        echo "Usuario: ".$usuario['usuario']."<br>";
        echo "Senha: ".$usuario['senha']."<br>";
        echo "Nome: ".$usuario['nome']."<br>";
        echo "Email: ".$usuario['email']."<br>";
        echo "<hr>";
    }
} else {
    echo "Sem resultado";
}

// Aula 24 -> INSERT
//$banco->insert("usuarios", array(
//    "usuario" => "user_aula24",
//    "senha" => md5("senha_aula24"),
//    "nome" => "Usuario da aula 24"
//));
//
//echo "Inserido com sucesso.<br>";
//$banco->query("SELECT * FROM usuarios");
//echo "Total usuarios: ".$banco->numRows();

// Aula 25 -> UPDATE
//$banco->update(
//        'usuarios',
//        array(
//            'nome' => 'Usuario aula 25 alterado',
//            'data' => date('d/m/Y')
//        ),
//        array(
//            'id' => 5
//        )
//);
//$banco->query("SELECT * FROM usuarios WHERE id='5'");
//print_r($banco->result());

// Aula 26 -> DELETE
//$banco->delete(
//        "usuarios",
//        array(
//            "id" => 5
//        )
//);
//$banco->query("SELECT * FROM usuarios");
//print_r($banco->result());
?>