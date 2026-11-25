<?php
/**
 * Estructura HTML común a todas las páginas (como _Layout.cshtml).
 * @var string $contenido HTML de la vista, preparado por View::render().
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Necesario para que la página se adapte a celulares y tablets -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ciudades por país</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <main>
        <?= $contenido /* Ya viene escapado desde la vista: no se vuelve a escapar */ ?>
    </main>
    <script src="/js/app.js"></script>
</body>
</html>
