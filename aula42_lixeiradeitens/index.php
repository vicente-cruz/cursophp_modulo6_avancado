<?php
require "config.php";
?>

<h1>Lista de usuários</h1>
<table border="1" width="800">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = $pdo->query("SELECT * FROM usuarios WHERE status = '1'");
        if ($query->rowCount() > 0) {
            foreach($query->fetchAll() as $usuario):
    ?>
        <tr>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><a href="excluir.php?id=<?php echo $usuario['id']?>">Excluir</a></td>
        </tr>
    <?php
            endforeach;
        }
    ?>
    </tbody>
</table>