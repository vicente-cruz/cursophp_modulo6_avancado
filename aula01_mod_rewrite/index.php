<?php


/**
 * URL Amigavel -> Mod-Rewrite.
 * 
 * 1 - Entrar em C:\xampp\apache\conf\httpd.conf
 * 2 - Descomentar ou inserir a linha: "LoadModule rewrite_module modules/mod_rewrite.so"
 * 3 - Reiniciar o APACHE.
 * 
 * 4-Criar um arquivo chamado ".htaccess", configurando-o para ignorar "arquivos", "diret�rios" e para modificar URL amigaveis.
 * Inserir:
 * ...
 * RewriteCond %{REQUEST_FILENAME} !-f
 * RewriteCond %{REQUEST_FILENAME} !-d
 * RewriteRule ^(.*)$ /index.php?q=$1 [L]
 *      OBS: Para esta configuração, TANTO O "INDEX.PHP" QUANTO O ".HTACCESS" DEVEM ESTAR NA "PASTA RAIZ"
 *  */

print_r($_GET);

?>