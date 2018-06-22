<?php require 'pages/header.php'; ?>
<?php
if (empty($_SESSION['cLogin'])) {
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php
    exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if (isset($_POST['titulo']) && ( ! empty($_POST['titulo'])) &&
    isset($_GET['id']) && ( ! empty($_GET['id']))) {
    $id = addslashes($_GET['id']);
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);
    
    $fotos = ( isset($_FILES['fotos']) ? $_FILES['fotos'] : array() );
    
    $a->editAnuncio($id, $titulo, $categoria, $valor, $descricao, $estado, $fotos, $id);
?>
    <div class="alert alert-success">
        Produto editado com sucesso!
    </div>
<?php
}

if (isset($_GET['id']) && ( ! empty($_GET['id']))) {
    $id = addslashes($_GET['id']);
    $anuncio = $a->getAnuncio($id);
}
else
{
?>
    <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
<?php
    exit;
}

?>
<div class="container">
    <h1>Meus anúncios - Editar anúncio</h1>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
            <?php
                require 'classes/categorias.class.php';
                $c = new Categorias();
                $categorias = $c->getCategorias();
                foreach ($categorias as $cat):
            ?>
                <option value="<?php echo $cat['id']?>" <?php echo ( $anuncio['id_categoria'] == $cat['id'] ? "selected='selected'" : ""); ?>><?php echo utf8_encode($cat['nome'])?></option>
            <?php
                endforeach;
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="categoria">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $anuncio['titulo']; ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="categoria">Valor:</label>
            <input type="text" name="valor" id="valor" value="<?php echo $anuncio['valor']; ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="categoria">Descrição:</label>
            <textarea name="descricao" class="form-control"><?php echo $anuncio['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="categoria">Estado de conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0" <?php echo ( $anuncio['estado'] == 0 ? "selected='selected'" : ""); ?>>Ruim</option>
                <option value="1" <?php echo ( $anuncio['estado'] == 1 ? "selected='selected'" : ""); ?>>Bom</option>
                <option value="2" <?php echo ( $anuncio['estado'] == 2 ? "selected='selected'" : ""); ?>>Ótimo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="add_foto">Fotos do anúncio:</label>
            <input type="file" name="fotos[]" multiple /></br>
            
            <div class="panel panel-default">
                <div class="panel-heading">Fotos do anúncio</div>
                <div class="panel-body">
                    <?php foreach ($anuncio['fotos'] as $foto): ?>
                    <div class="foto_item">
                        <img src="assets/images/anuncios/<?php echo $foto['url']; ?>" class="img-thumbnail" border="0" /><br/>
                        <a href="excluir-foto.php?id=<?php echo $foto['id']; ?>" class="btn btn-default">Excluir imagem</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
        <input type="submit" value="Salvar" class="btn btn-default" />
    </form>
</div>
<?php require 'pages/footer.php'; ?>