<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

/* Acceso a la tabla `city`. */

final class Ciudad
{
    public function __construct(private PDO $db)
    {
    }

    public function porPais(string $codigoPais): array
    {
        $stmt = $this->db->prepare(
            'SELECT Name, Population
               FROM city
              WHERE CountryCode = :codigo
              ORDER BY Population DESC, Name'
        );
        $stmt->execute(['codigo' => $codigoPais]);

        return $stmt->fetchAll();
    }
}
