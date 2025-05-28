<?php

require __DIR__.'/../vendor/autoload.php';

// Carregar o kernel do Laravel para testes
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Criar uma requisição para uma rota de admin
$request = Illuminate\Http\Request::create('/admin/dashboard', 'GET');

// Autenticar com um usuário admin
$user = App\Models\User::where('role', 'admin')->first();
if ($user) {
    echo "Autenticando como: " . $user->name . " (role: " . $user->role . ")\n";
    auth()->login($user);
} else {
    echo "Nenhum usuário admin encontrado\n";
    exit;
}

// Tentar acessar a rota
try {
    echo "Tentando acessar a rota: /admin/dashboard\n";
    $response = $kernel->handle($request);
    echo "Status da resposta: " . $response->getStatusCode() . "\n";
    
    if ($response->isRedirect()) {
        echo "Redirecionado para: " . $response->headers->get('Location') . "\n";
    } else {
        echo "Conteúdo da resposta:\n";
        echo substr($response->getContent(), 0, 500) . "...\n";
    }
} catch (\Exception $e) {
    echo "Erro ao acessar a rota: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . " (linha " . $e->getLine() . ")\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nTeste concluído.\n";
