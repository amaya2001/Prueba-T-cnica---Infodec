<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Models\Ciudad;
use App\Models\Pais;

/* Aqui se define la pantalla principal, se verifica a traves de la query el codigo enviado por el formulario, sabiendo que el código es unicamente de
   tres letras se realiza esta verificación.

   Esto lo que me permite es generar una vista o acción en el momento en donde el codigo sea modificado manualmente en la url y que 
   no aparezca un errpor de PHP.

*/
final class ConsultaController
{
    public function __construct(
        private Pais $paises,
        private Ciudad $ciudades,
    ) {
    }


    public function index(array $query): void
    {
        $codigo           = null;  
        $paisSeleccionado = null;  
        $ciudades         = [];
        $error            = null;

        if (array_key_exists('pais', $query)) {
            $valor = $query['pais'];

            if (!is_string($valor) || trim($valor) === '') {
                $error = 'Selecciona un país para consultar sus ciudades.';
            } else {
                $codigo = strtoupper(trim($valor));

                if (preg_match('/^[A-Z]{3}$/', $codigo) === 1) { # Verficación de las tres letras
                    $paisSeleccionado = $this->paises->buscarPorCodigo($codigo);
                }

                if ($paisSeleccionado === null) {
                    $error = 'El país seleccionado no existe. Elige uno de la lista.';
                } else {
                    $ciudades = $this->ciudades->porPais($codigo);
                }
            }
        }

        View::render('consulta', [ # Respuestas en forma de vistas
            'paises'           => $this->paises->todos(),
            'codigo'           => $codigo,
            'paisSeleccionado' => $paisSeleccionado,
            'ciudades'         => $ciudades,
            'error'            => $error,
        ]);
    }
}
