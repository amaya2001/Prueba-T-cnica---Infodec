-- =====================================================================
-- Consultas  sobre la base de ejemplo "world" de MySQL


-- Usar la base de datos creada
USE world;


-- Investigación tabla 'city'
DESCRIBE city;
SHOW CREATE TABLE city;

SELECT * FROM city LIMIT 10;

-- Investigación tabla 'country'
DESCRIBE country;
SHOW CREATE TABLE country;

SELECT * FROM country LIMIT 10;

-- 1. Obtener todas las ciudades con una población menor o igual a 100,000 habitantes. 

SELECT ci.Name        AS ciudad,
       co.Name        AS pais,
       ci.Population  AS poblacion
FROM city ci
JOIN country co ON co.Code = ci.CountryCode
WHERE ci.Population <= 100000
ORDER BY ci.Population DESC, ci.Name;

-- 2. Realizar un conteo de las ciudades cuyo nombre comience con la letra "R". 

SELECT COUNT(*) AS ciudades_con_r
FROM city
WHERE Name LIKE 'R%';

-- 3. Mostrar el Top 10 de las ciudades donde se hable español.
-- Como no se especifico que tuviera que ser el idioma oficial, entonces deje por fuera este filtro 

SELECT ci.Name        AS ciudad,
       ci.Population  AS poblacion,
       cl.IsOfficial  AS es_oficial,
       cl.Percentage  AS porcentaje_hablantes
FROM city ci
JOIN countrylanguage cl  ON cl.CountryCode = ci.CountryCode
WHERE cl.Language = 'Spanish'
ORDER BY ci.Population DESC
LIMIT 10;
