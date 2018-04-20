<?php
session_start();

if (isset($_GET['lang']) && ( ! empty($_GET['lang']))) {
    $_SESSION['lang'] = $_GET['lang'];
}

require "config.php";
require "language.class.php";
$lang = new language();
?>
<a href="index.php?lang=en">English</a>
<a href="index.php?lang=pt-br">Português(Brasil)</a>
<a href="index.php?lang=fr">Français</a>
<hr/>
Linguagem definida: <?php echo $lang->getLanguage(); ?>
<hr/>

<button><?php $lang->get('BUY'); ?></button><br/><br/>

Categoria: <?php $lang->get('CATEGORIA_PHOTO'); ?><br/><br/>

<?php
$sql = 
    "SELECT"
    . " cat.id, lng.valor "
    . " FROM "
    . "     categorias AS cat"
    . " INNER JOIN "
    . "     lang AS lng"
    . " ON  lng.nome = cat.lang_item"
    . " AND lng.lang = :lang ";
$query = $pdo->prepare($sql);
$query->bindValue(":lang", $lang->getLanguage());
$query->execute();

// Lista todas as palavras da linguagem atual.
if ($query->rowCount() > 0) {
    foreach ($query->fetchAll() as $categoria) {
        echo $categoria['id']." - ".utf8_encode($categoria['valor'])."<br/>";
    }
}
?>