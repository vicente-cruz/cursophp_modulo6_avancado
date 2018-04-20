<?php
require 'config.php';

$sql = "SELECT * FROM filmes";
$query = $pdo->query($sql);
if ($query->rowCount() > 0) {
    foreach ($query->fetchAll() as $filme):
?>
<fieldset>
    <legend>Filme: <strong><?php echo $filme['titulo']; ?></strong></legend>
    <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=1"><img src="star.png" height="20" /></a>
    <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=2"><img src="star.png" height="20" /></a>
    <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=3"><img src="star.png" height="20" /></a>
    <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=4"><img src="star.png" height="20" /></a>
    <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=5"><img src="star.png" height="20" /></a>
    ( <?php echo $filme['media']; ?> )
</fieldset>
<?php        
    endforeach;
}
else {
    echo "Não há filmes cadastrados!<br/>";
}

?>