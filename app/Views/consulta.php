<?php
/**
 * Pantalla principal.
 * @var array       $paises            Lista de países [Code, Name]
 * @var string|null $codigo            Código enviado por el formulario
 * @var array|null  $paisSeleccionado  País válido seleccionado
 * @var array       $ciudades          Ciudades del país [Name, Population]
 * @var string|null $error             Mensaje de validación
 */
?>
<h1>Ciudades por país</h1>
<p>Selecciona un país para ver sus ciudades y la población registrada de cada una.</p>

<form method="get" action="">
    <label for="pais">País</label>
    <select id="pais" name="pais" required>
        <option value="">Selecciona un país…</option>
        <?php foreach ($paises as $pais): ?>
            <option value="<?= e($pais['Code']) ?>"<?= $pais['Code'] === $codigo ? ' selected' : '' ?>>
                <?= e($pais['Name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Consultar</button>
</form>

<?php if ($error !== null): ?>
    <p class="alerta" role="alert"><?= e($error) ?></p>

<?php elseif ($paisSeleccionado !== null): ?>
    <h2>Ciudades de <?= e($paisSeleccionado['Name']) ?></h2>

    <?php if ($ciudades === []): ?>
        <p class="vacio">No hay ciudades registradas para este país.</p>
    <?php else: ?>
        <p><?= count($ciudades) ?> <?= count($ciudades) === 1 ? 'ciudad registrada' : 'ciudades registradas' ?></p>
        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col" class="numero">Población</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ciudades as $i => $ciudad): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= e($ciudad['Name']) ?></td>
                            <td class="numero"><?= number_format($ciudad['Population'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<?php endif; ?>
