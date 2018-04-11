<?php
// cURL -> Acesso a sites externos (webservices, etc)

$ch = curl_init();

// IMPORTANTE!! Dependendo, deve-se configurar o PROXY!
//curl_setopt($ch, CURLOPT_PROXY, "tcp://10.76.64.14:3128");
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, "vicentesc:V1crUz81@1307");
// Define a URL de envio
curl_setopt($ch, CURLOPT_URL, "http://www.checkitout.com.br/wb/pingpong");
//curl_setopt($ch, CURLOPT_URL, "http://54.207.61.247/wb/pingpong");
// O Método (GET, POST...)
curl_setopt($ch, CURLOPT_POST, 1);
// Informacoes enviadas
curl_setopt($ch, CURLOPT_POSTFIELDS, "nome=Vicente&idade=35&sexo=masculino");
// Aguardando resposta
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

// Recebe resposta
$resposta = curl_exec($ch);

curl_close($ch);

print_r($resposta);
?>