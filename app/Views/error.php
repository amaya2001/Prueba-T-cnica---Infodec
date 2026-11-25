<?php
/**
 * Página de error del servidor.
 * @var string      $mensaje  Mensaje para el usuario
 * @var string|null $detalle  Detalle técnico, solo en modo debug
 */
?>
<h1>Algo salió mal</h1>
<p class="alerta" role="alert"><?= e($mensaje) ?></p>
<?php if ($detalle !== null): ?>
    <pre><?= e($detalle) ?></pre>
<?php endif; ?>
