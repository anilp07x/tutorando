<?php
// Este script simula um login e depois uma requisição para a rota admin/test

// 1. Obter token CSRF
$base_url = 'http://127.0.0.1:8002';
$login_url = $base_url . '/login';
$admin_url = $base_url . '/admin/test';

$cookie_file = tempnam(sys_get_temp_dir(), 'cookie_');

// Função para fazer uma requisição
function make_request($url, $post_data = null, $cookie_file) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    
    if ($post_data) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }
    
    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    
    curl_close($ch);
    
    return [
        'info' => $info,
        'headers' => $headers,
        'body' => $body
    ];
}

// Obter o token CSRF
echo "Obtendo token CSRF...\n";
$login_page = make_request($login_url, null, $cookie_file);

preg_match('/<meta name="csrf-token" content="([^"]+)"/', $login_page['body'], $matches);
$csrf_token = $matches[1] ?? null;

if (!$csrf_token) {
    echo "Erro: Token CSRF não encontrado\n";
    exit;
}

echo "Token CSRF: $csrf_token\n\n";

// Tentar fazer login
echo "Tentando fazer login...\n";
$login_data = [
    '_token' => $csrf_token,
    'email' => 'admin@tutorando.com',
    'password' => 'password'
];

$login_response = make_request($login_url, $login_data, $cookie_file);

echo "Status do login: " . $login_response['info']['http_code'] . "\n";
echo "Redirect URL: " . $login_response['info']['redirect_url'] . "\n\n";

// Tentar acessar a rota admin
echo "Tentando acessar a rota admin...\n";
$admin_response = make_request($admin_url, null, $cookie_file);

echo "Status: " . $admin_response['info']['http_code'] . "\n";
echo "Redirect URL: " . $admin_response['info']['redirect_url'] . "\n";

echo "\nBody da resposta admin:\n";
if (strlen($admin_response['body']) > 500) {
    echo substr($admin_response['body'], 0, 500) . "... [truncado]";
} else {
    echo $admin_response['body'];
}

// Limpar
unlink($cookie_file);
echo "\n\nTeste concluído.\n";
