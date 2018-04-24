<?php

$routes = array();

$routes['/galeria/{id}/{titulo}'] = '/galeria/abrir/:id/:titulo';
$routes['/news/{id}'] = '/noticia/abrir/:id';
$routes['/n/{titulo}'] = '/noticia/abrirTitulo/:titulo';

$url = "/galeria/25/teste";

echo "URL digitada: <strong>".$url."</strong><br/><br/>";

foreach ($routes as $route => $newurl) {
    echo "Padrão a ser mapeado: <strong>".$route."</strong> => <strong>".$newurl."</strong><br/><br/>";
    
    echo "Parte 1) Substitui os templates da rota pela expressao regular (RegEx).<br/>";
    $route_pattern = preg_replace('(\{[a-z0-9]{1,}\})','([a-z0-9-]{1,})',$route);
    echo "<strong>".$route."</strong> => <strong>".$route_pattern."</strong><br/><br/>";
    
    echo "Parte 2) Verifica se a URL digitada <strong>'".$url."'</strong> possui a RegEx <strong>'".$route_pattern."'</strong><br/>";
    echo "A URL <strong>'".$url."'</strong> casa com o padrão <strong>'".$route_pattern."'</strong>?<br/>";
    if (preg_match("#^(".$route_pattern.")*$#i",$url,$vals_url_amiga) === 1) {
        // Exclui os matches correspondentes à URL inteira.
        // Fica apenas com os matches a serem substituidos
        array_shift($vals_url_amiga);
        array_shift($vals_url_amiga);
        echo "<strong>Valores URL amigável</strong>: "; print_r($vals_url_amiga);
        echo "<br/><br/>";
        
        $itens = array();
        echo "Parte 3) Extrai os templates.<br/>";
        echo "A rota <strong>'".$route."'</strong> casa com o padrão <strong>'(\{[a-z0-9]{1,}\})'</strong>?<br/>";
        if (preg_match_all('(\{[a-z0-9]{1,}\})', $route, $templates)) {
            echo "<strong>Templates</strong>: "; print_r($templates[0]);
            echo "<br/><br/>";
            
            echo "Parte 4) Remove chaves dos templates, ficam só ids.<br/>";
            // Se encontrar '{' e/ou '}', substitui por vazio.
            $id_templates = preg_replace('(\{|\})', '', $templates[0]);
            echo "<strong>itens</strong>: "; print_r($id_templates);
            echo "<br/><br/>";
        }
        
        echo "Parte 5) Mapeia cada 'id' da rota ao seu respectivo 'valor'<br/>";
        $mapeamento = array();
        foreach ($vals_url_amiga as $key => $val_url_amiga) {
            $mapeamento[$id_templates[$key]] = $val_url_amiga;
        }
        echo "Mapeamento <strong>ID => Valor</strong>: "; print_r($mapeamento);
        echo "<br/><br/>";
        
        echo "Parte 6) Gera a nova URL, mapeando :ids => valor<br/>";
        foreach ($mapeamento as $mapid => $mapval) {
            $newurl = str_replace(":".$mapid, $mapval, $newurl);
        }
        echo "<strong>URL Efetiva</strong>: "; print_r($newurl);
        break;
    }
    else {
        echo "NÃO!<br/>";
    }
    
    echo "<br/><br/>";
}