<?php

class Anuncios {
    
    public function getTotalAnuncios($filtros)
    {
        global $pdo;

        $filtrostring = array("1=1");
        if ( ! empty($filtros['categoria'])) {
            $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
        }
        if ( ! empty($filtros['preco'])) {
            $filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
        }
        if ($filtros['estado'] != '') {
            $filtrostring[] = 'anuncios.estado = :estado';
        }

        $query = $pdo->prepare("SELECT COUNT(*) AS c FROM anuncios WHERE ".implode(' AND ',$filtrostring));

        if ( ! empty($filtros['categoria'])) {
            $query->bindValue(":id_categoria", $filtros['categoria']);
        }
        if ( ! empty($filtros['preco'])) {
            $preco = explode("-", $filtros['preco']);
            $query->bindValue(":preco1", $preco[0]);
            $query->bindValue(":preco2", $preco[1]);
        }
        if ($filtros['estado'] != '') {
            $query->bindValue(":estado", $filtros['estado']);
        }
        
        $query->execute();
        $row = $query->fetch();
        
        return $row['c'];
    }
    
    public function getMeusAnuncios()
    {
        global $pdo;
        
        $anuncios = array();
        $query = $pdo->prepare(" SELECT "
                . "*,"
                . " ("
                . "     SELECT "
                . "         anuncios_imagens.url"
                . "     FROM"
                . "         anuncios_imagens"
                . "     WHERE "
                . "         anuncios_imagens.id_anuncio = anuncios.id"
                . "     LIMIT 1"
                . ") AS url"
                . " FROM "
                . "anuncios"
                . " WHERE "
                . "id_usuario = :id_usuario");
        $query->bindValue(":id_usuario",$_SESSION['cLogin']);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $anuncios = $query->fetchAll();
        }
        
        return $anuncios;
    }
    
    public function getUltimosAnuncios($page, $perPage, $filtros)
    {
        global $pdo;
        
        $offset = ($page - 1) * $perPage;
        
        $anuncios = array();
        
        $filtrostring = array("1=1");
        if ( ! empty($filtros['categoria'])) {
            $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
        }
        if ( ! empty($filtros['preco'])) {
            $filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
        }
        if ($filtros['estado'] != '') {
            $filtrostring[] = 'anuncios.estado = :estado';
        }
        
        $sql =  "SELECT "
                . "*,"
                . " ("
                . "     SELECT "
                . "         anuncios_imagens.url"
                . "     FROM"
                . "         anuncios_imagens"
                . "     WHERE "
                . "         anuncios_imagens.id_anuncio = anuncios.id"
                . "     LIMIT 1"
                . ") AS url,"
                . " ("
                . "     SELECT "
                . "         categorias.nome"
                . "     FROM"
                . "         categorias"
                . "     WHERE "
                . "         categorias.id = anuncios.id_categoria"
                . ") AS categoria"
                . " FROM "
                . "anuncios"
                . " WHERE "
                . implode(" AND ", $filtrostring)
                . " ORDER BY "
                . "id"
                . " DESC "
                . " OFFSET "
                . " ".$offset." "
                . " LIMIT "
                . " ".$perPage." ";
        
        $query = $pdo->prepare($sql);
        
        if ( ! empty($filtros['categoria'])) {
            $query->bindValue(":id_categoria", $filtros['categoria']);
        }
        if ( ! empty($filtros['preco'])) {
            $preco = explode("-", $filtros['preco']);
            $query->bindValue(":preco1", $preco[0]);
            $query->bindValue(":preco2", $preco[1]);
        }
        if ($filtros['estado'] != '') {
            $query->bindValue(":estado", $filtros['estado']);
        }
        
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $anuncios = $query->fetchAll();
        }
        
        return $anuncios;
    }
    
    public function getAnuncio($id)
    {
        $anuncio = array();
        global $pdo;
        
        $query = $pdo->prepare(""
                . "SELECT"
                . " *,"
                . "("
                . " SELECT "
                . "  categorias.nome"
                . " FROM"
                . "  categorias"
                . " WHERE "
                . "  categorias.id = anuncios.id_categoria"
                . ") AS categoria,"
                . "("
                . " SELECT "
                . "  usuarios.telefone"
                . " FROM"
                . "  usuarios"
                . " WHERE "
                . "  usuarios.id = anuncios.id_usuario"
                . ") AS telefone "
                . "FROM"
                . " anuncios "
                . "WHERE"
                . " id = :id"
                );
        $query->bindValue(":id",$id);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $anuncio = $query->fetch();
            
            $anuncio['fotos'] = array();
            
            $query = $pdo->prepare("SELECT id, url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
            $query->bindValue(":id_anuncio", $id);
            $query->execute();
            
            if ($query->rowCount() > 0) {
                $anuncio['fotos'] = $query->fetchAll();
            }
            
        }
        
        return $anuncio;
    }
    
    public function addAnuncio($titulo, $categoria, $valor, $descricao, $estado)
    {
        global $pdo;
        
        $query = $pdo->prepare("INSERT INTO anuncios(titulo, id_usuario, id_categoria, valor, descricao, estado) VALUES (:titulo, :id_usuario, :id_categoria, :valor, :descricao, :estado)");
        $query->bindValue(":titulo",$titulo);
        $query->bindValue(":id_usuario",$_SESSION['cLogin']);
        $query->bindValue(":id_categoria",$categoria);
        $query->bindValue(":valor",$valor);
        $query->bindValue(":descricao",$descricao);
        $query->bindValue(":estado",$estado);
        $query->execute();
    }
    
    public function deleteAnuncio($id)
    {
        global $pdo;
        $query = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
        $query->bindValue(":id_anuncio",$id);
        $query->execute();

        $query = $pdo->prepare("DELETE FROM anuncios WHERE id = :id");
        $query->bindValue(":id",$id);
        $query->execute();
        
        
    }
    
    public function editAnuncio($id, $titulo, $categoria, $valor, $descricao, $estado, $fotos)
    {
        global $pdo;
        
        $query = $pdo->prepare("UPDATE anuncios SET titulo = :titulo, id_usuario = :id_usuario, id_categoria = :id_categoria, valor = :valor, descricao = :descricao, estado = :estado WHERE id = :id");
        $query->bindValue(":id",$id);
        $query->bindValue(":titulo",$titulo);
        $query->bindValue(":id_usuario",$_SESSION['cLogin']);
        $query->bindValue(":id_categoria",$categoria);
        $query->bindValue(":valor",$valor);
        $query->bindValue(":descricao",$descricao);
        $query->bindValue(":estado",$estado);
        $query->execute();
        
        if (count($fotos['tmp_name']) > 0) {
            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];
                $tmpname = "";
                if (in_array($tipo, array("image/jpeg", "image/png"))) {
                    $tmpname = md5(time().rand(0,9999)).".jpg";
                    move_uploaded_file($fotos['tmp_name'][$q], "assets/images/anuncios/".$tmpname);
                    
                    list($width_orig, $height_orig) = getimagesize("assets/images/anuncios/".$tmpname);
                    $ratio = $width_orig / $height_orig;
                    
                    $width = 500;
                    $height = 500;
                    
                    if ($width/$height > $ratio) {
                        $width = $height*$ratio;
                    }
                    else {
                        $height = $width/$ratio;
                    }
                    
                    $img = imagecreatetruecolor($width, $height);
                    $origi = ( $tipo == 'image/jpeg' ? imagecreatefromjpeg("assets/images/anuncios/".$tmpname) : imagecreatefrompng("assets/images/anuncios/".$tmpname) );
                    
                    imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagejpeg($img, "assets/images/anuncios/".$tmpname, 80);
                }
                
                $query = $pdo->prepare("INSERT INTO anuncios_imagens(id_anuncio, url) VALUES (:id_anuncio, :url)");
                $query->bindValue(":id_anuncio", $id);
                $query->bindValue(":url", $tmpname);
                $query->execute();
            }
        }
    }
    
    public function deleteFoto($id)
    {
        global $pdo;
        $id_anuncio = 0;
        
        $query = $pdo->prepare("SELECT id_anuncio FROM anuncios_imagens WHERE id = :id");
        $query->bindValue(":id",$id);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $anuncio = $query->fetch();
            $id_anuncio = $anuncio['id_anuncio'];
        }
        
        $query = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id = :id");
        $query->bindValue(":id",$id);
        $query->execute();
        
        return $id_anuncio;
    }
}
