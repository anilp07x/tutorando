<?php
// Este script simula uma requisição para a rota admin/test

$url = 'http://127.0.0.1:8002/admin/test';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, true);

// Obter cookies de sessão
$cookie_file = tempnam(sys_get_temp_dir(), 'cookie_');
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

// Executar a requisição
$response = curl_exec($ch);
$info = curl_getinfo($ch);

echo "URL: {$url}\n";
echo "Status: {$info['http_code']}\n";
echo "Redirect URL: {$info['redirect_url']}\n";

// Exibir headers
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);

echo "\nHeaders:\n";
echo $headers;

echo "\nBody:\n";
if (strlen($body) > 1000) {
    echo substr($body, 0, 1000) . "... [truncado]";
} else {
    echo $body;
}

curl_close($ch);
unlink($cookie_file);

echo "\n\nTeste concluído.\n";
