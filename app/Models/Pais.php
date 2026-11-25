<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

/* Acceso a la tabla `country`. */
final class Pais
{
    public function __construct(private PDO $db)
    {
    }

    /* Aqui se define el query para todos los países, ordenados por nombre, para la lista desplegable. */
    public function todos(): array
    {
        return $this->db
            ->query('SELECT Code, Name FROM country ORDER BY Name')
            ->fetchAll();
    }

    /**
     * Un país por su código (por ejemplo "COL"), o null si no existe.
     */
    public function buscarPorCodigo(string $codigo): ?array
    {
        // Consulta preparada: :codigo es un parámetro, nunca texto concatenado.
        $stmt = $this->db->prepare('SELECT Code, Name FROM country WHERE Code = :codigo');
        $stmt->execute(['codigo' => $codigo]);

        $pais = $stmt->fetch();

        # fetch() devuelve false cuando no hay filas.
        return $pais === false ? null : $pais;
    }
}
