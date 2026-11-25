# Ciudades por país

Aplicación web en PHP 8 con patrón MVC propio y MySQL. Permite seleccionar un país y ver sus ciudades con la población registrada de cada una.

Usa la base de datos de ejemplo `world` de MySQL.

## Requisitos

- PHP 8.x con la extensión `pdo_mysql` activa
- MySQL 8.x con la base `world` instalada

## Instalación

1. Clona el repositorio.
2. Copia `config/config.example.php` como `config/config.php`.
3. Escribe en `config/config.php` el usuario y la contraseña de MySQL.
4. Desde la carpeta del proyecto, inicia el servidor de desarrollo:

   ```
   php -S localhost:8000 -t public
   ```

5. Abre http://localhost:8000 en el navegador.

## Estructura

```
public/       Punto de entrada (index.php), CSS y JavaScript
app/Core/     Conexión a la base de datos y renderizado de vistas
app/Models/   Consultas SQL con PDO
app/Controllers/  Lógica de la pantalla y validaciones
app/Views/    Plantillas HTML
config/       Configuración (config.php no se publica)
sql/          Consultas SQL de la actividad
```
