<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "proyecto sony";

$conexion = mysqli_connect($servidor, $usuario, $clave, $bd);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// No iniciamos sesión aquí, solo configuramos la conexión
return $conexion;