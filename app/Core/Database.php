<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

/* Aqui se crea la conexión PDO a MySQL a partir de la configuración. */
final class Database
{
    public static function connect(array $db): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $db['host'],
            $db['port'],
            $db['name'],
            $db['charset']
        );

        return new PDO($dsn, $db['user'], $db['password'], [
            # Ante un error SQL, lanzar PDOException en lugar de fallar en silencio.
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            # Cada fila llega como arreglo asociativo: $fila['Name'].
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            # Usar sentencias preparadas reales de MySQL, no simuladas por PHP.
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
}
