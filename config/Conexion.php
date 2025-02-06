<?php 
require_once "global.php"; // Incluir el archivo de configuración global

// Crear una nueva conexión a la base de datos usando las constantes definidas en global.php
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Establecer el conjunto de caracteres para la conexión
mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

// Si hay un posible error en la conexión, mostrarlo
if (mysqli_connect_error())
{
    printf("Falló conexión a la base de datos: %s\n", mysqli_connect_error());
    exit();
}

// Si no existe la función ejecutarConsulta, definirla junto con otras funciones
if (!function_exists('ejecutarConsulta'))
{
    // Función para ejecutar una consulta y devolver el resultado
    function ejecutarConsulta($sql)
    {
        global $conexion;
        $query = $conexion->query($sql);
        return $query;
    }

    // Función para ejecutar una consulta y devolver una única fila
    function ejecutarConsultaSimpleFila($sql)
    {
        global $conexion;
        $query = $conexion->query($sql);        
        $row = $query->fetch_assoc();
        return $row;
    }

    // Función para ejecutar una consulta y devolver el ID del último registro insertado
    function ejecutarConsulta_retornarID($sql)
    {
        global $conexion;
        $query = $conexion->query($sql);        
        return $conexion->insert_id;            
    }

    // Función para limpiar una cadena de caracteres especiales y potencialmente peligrosos
    function limpiarCadena($str)
    {
        global $conexion;
        $str = mysqli_real_escape_string($conexion, trim($str));
        return htmlspecialchars($str);
    }
}
?>
