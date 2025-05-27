<?php

require __DIR__.'/../vendor/autoload.php';

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Carregar o kernel do Laravel para testes
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Verificar se existe um usuário admin
$admin = User::where('role', 'admin')->first();

if ($admin) {
    echo "Usuário admin encontrado: " . $admin->name . " (" . $admin->email . ")\n";
} else {
    echo "Nenhum usuário admin encontrado.\n";
    
    // Criar um usuário admin
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
    
    echo "Usuário admin criado: " . $admin->name . " (" . $admin->email . ")\n";
}

// Verificar rotas de admin
$routes = Route::getRoutes();
$adminRoutes = collect($routes)->filter(function ($route) {
    return str_starts_with($route->uri, 'admin/');
});

echo "\nRotas de admin registradas:\n";
foreach ($adminRoutes as $route) {
    echo $route->uri . " => " . $route->getActionName() . "\n";
}

echo "\nVerificando o Middleware:\n";
$middleware = app(\App\Http\Middleware\IsAdmin::class);
$reflectionMethod = new ReflectionMethod($middleware, 'handle');
$parameters = $reflectionMethod->getParameters();
echo "Middleware 'IsAdmin' tem " . count($parameters) . " parâmetros.\n";

echo "\nTeste concluído.\n";
