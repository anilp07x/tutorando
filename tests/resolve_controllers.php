<?php

require __DIR__.'/../vendor/autoload.php';

// Carregar o kernel do Laravel para testes
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Tentar resolver os controllers de admin
$controllers = [
    'App\\Http\\Controllers\\Admin\\DashboardController',
    'App\\Http\\Controllers\\Admin\\InstituicaoController',
    'App\\Http\\Controllers\\Admin\\UserController',
    'App\\Http\\Controllers\\Admin\\ProjetoController',
    'App\\Http\\Controllers\\Admin\\PublicacaoController'
];

foreach ($controllers as $controller) {
    echo "Verificando controller: " . $controller . "\n";
    try {
        $instance = app($controller);
        echo "✅ Controller resolvido com sucesso: " . get_class($instance) . "\n";
    } catch (\Exception $e) {
        echo "❌ Erro ao resolver controller: " . $e->getMessage() . "\n";
    }
}

echo "\nTeste concluído.\n";
