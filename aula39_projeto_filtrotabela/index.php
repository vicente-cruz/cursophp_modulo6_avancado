<?php
try {
    $pdo = new PDO("pgsql:dbname=projeto_filtrotabela;host=10.76.64.83","postgres","&kVyhG<({t}[");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "ERROR:".$e->getMessage();
    exit;
}

$sql = "SELECT * FROM usuarios ";
$sx = '';
if (isset($_POST['sexo']) && ( ! empty($_POST['sexo']))) {
    $sx = addslashes($_POST['sexo']);
    $sql .= "WHERE sexo = :sexo ";
    $query = $pdo->prepare($sql);
    $query->bindValue(":sexo",$sx);
}
else {
    $query = $pdo->prepare($sql);
}
$query->execute();
?>
<form method="POST">
    <select name="sexo">
        <option></option>
        <option value="1" <?php echo ( ($sx == '1') ? "selected='selected'" : ""); ?>>Masculino</option>
        <option value="2" <?php echo ( ($sx == '2') ? "selected='selected'" : ""); ?>>Feminino</option>
    </select>
    <input type="submit" value="Filtrar"/>
</form>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sexo</th>
            <th>Idade</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sexo = array(
            '1' => 'Masculino',
            '2' => 'Feminino'
        );
        
        if ($query->rowCount() > 0) {
            foreach($query->fetchAll() as $usuario):
        ?>
        <tr>
            <td><?php echo $usuario['nome'];?></td>
            <td><?php echo $sexo[$usuario['sexo']];?></td>
            <td><?php echo $usuario['idade'];?></td>
        </tr>
        <?php
            endforeach;
        }
        ?>
    </tbody>
</table>