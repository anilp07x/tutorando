<?php

require __DIR__.'/../vendor/autoload.php';

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;

// Carregar o kernel do Laravel para testes
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Encontrar um usuário admin
$admin = User::where('role', 'admin')->first();

if (!$admin) {
    echo "Nenhum usuário admin encontrado.\n";
    exit;
}

// Tentar autenticar o usuário admin
Auth::login($admin);

if (Auth::check()) {
    echo "Usuário autenticado com sucesso: " . Auth::user()->name . "\n";
    echo "Role: " . Auth::user()->role . "\n";
    
    // Testar o middleware IsAdmin
    $middleware = new IsAdmin();
    $request = Request::create('/admin/dashboard', 'GET');
    
    // Criar uma closure simples para testar o middleware
    $nextCalled = false;
    $next = function ($req) use (&$nextCalled) {
        $nextCalled = true;
        return response('Middleware passou');
    };
    
    // Executar o middleware
    try {
        $response = $middleware->handle($request, $next);
        if ($nextCalled) {
            echo "Middleware IsAdmin: PASSOU ✓ (O usuário tem permissão de admin)\n";
            echo "Resposta: " . $response->getContent() . "\n";
        } else {
            echo "Middleware IsAdmin: FALHOU ✗ (O usuário não tem permissão de admin)\n";
        }
    } catch (\Exception $e) {
        echo "Erro ao testar middleware: " . $e->getMessage() . "\n";
    }
} else {
    echo "Falha ao autenticar o usuário.\n";
}

echo "\nTeste concluído.\n";
