<?php
declare(strict_types=1);

namespace App\Core;

/* Aqui se define la vista del layout principal */
final class View
{
    public static function render(string $vista, array $datos = []): void
    {
        # Convierte ['paises' => [...]] en la variable $paises dentro de la vista.
        extract($datos, EXTR_SKIP);

        # Captura el HTML de la vista en lugar de enviarlo de inmediato...
        ob_start();
        require BASE_PATH . '/app/Views/' . $vista . '.php';
        $contenido = ob_get_clean();

        require BASE_PATH . '/app/Views/layout.php';
    }
}
