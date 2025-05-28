<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Verificar o registro de middlewares
$middlewareGroups = $kernel->getMiddlewareGroups();
$routeMiddleware = $kernel->getMiddlewareAliases();

echo "== Grupos de Middleware ==\n";
foreach ($middlewareGroups as $group => $middlewares) {
    echo "$group: " . implode(', ', $middlewares) . "\n";
}

echo "\n== Aliases de Middleware ==\n";
foreach ($routeMiddleware as $alias => $class) {
    echo "$alias: $class\n";
}

echo "\n== Verificando a existência do middleware IsAdmin ==\n";
if (class_exists(\App\Http\Middleware\IsAdmin::class)) {
    echo "✅ Classe IsAdmin existe\n";
} else {
    echo "❌ Classe IsAdmin NÃO existe\n";
}

echo "\n== Verificando os middlewares no Container ==\n";
try {
    $adminMiddleware = $app->make('admin');
    echo "✅ Middleware 'admin' pode ser resolvido pelo container\n";
    echo "Tipo: " . get_class($adminMiddleware) . "\n";
} catch (Exception $e) {
    echo "❌ Erro ao resolver middleware 'admin': " . $e->getMessage() . "\n";
}

echo "\n== Verificando os middlewares de terminação ==\n";
$terminatingMiddleware = [];
try {
    $reflection = new ReflectionClass($kernel);
    $property = $reflection->getProperty('terminatingMiddleware');
    $property->setAccessible(true);
    $terminatingMiddleware = $property->getValue($kernel);
    
    echo "Middlewares de terminação: " . implode(', ', array_keys($terminatingMiddleware)) . "\n";
} catch (Exception $e) {
    echo "Erro ao acessar middlewares de terminação: " . $e->getMessage() . "\n";
}

echo "\nTeste concluído.\n";
