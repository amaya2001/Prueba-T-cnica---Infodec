<?php
declare(strict_types=1);

use App\Controllers\ConsultaController;
use App\Core\Database;
use App\Core\View;
use App\Models\Ciudad;
use App\Models\Pais;


# Carpeta raíz del proyecto: un nivel arriba de /public.
define('BASE_PATH', dirname(__DIR__));

# 1. Cargar la configuración.
$configFile = BASE_PATH . '/config/config.php';
if (!is_file($configFile)) {
    http_response_code(500);
    exit('Falta config/config.php. Copia config/config.example.php y escribe tus credenciales.');
}
$config = require $configFile;

# 2. Mostrar u ocultar errores según el modo.
error_reporting(E_ALL);
ini_set('display_errors', $config['debug'] ? '1' : '0');

# 3. Autocarga de clases: App\Core\Database  ->  app/Core/Database.php
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

# 4. Funciones auxiliares para las vistas
require BASE_PATH . '/app/Core/helpers.php';

// 5. Crear los objetos
try {
    $pdo = Database::connect($config['db']);

    $controller = new ConsultaController(new Pais($pdo), new Ciudad($pdo));
    $controller->index($_GET);
} catch (PDOException $e) {
    http_response_code(500);
    View::render('error', [
        'mensaje' => 'No fue posible consultar la base de datos. Intenta de nuevo más tarde.',
        'detalle' => $config['debug'] ? $e->getMessage() : null,
    ]);
}
