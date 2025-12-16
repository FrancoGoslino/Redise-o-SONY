<?php
global $conexion;

require_once "conexion.php";

$nombre = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["nombre"])));
$apellido = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["apellido"])));
$mail = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["mail"])));
$usuario = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["usuario"])));
$clave = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["clave"])));

$consulta_sql =
    "INSERT INTO usuarios (nombre, apellido, mail, usuario, clave, permiso)
    VALUES ('$nombre','$apellido','$mail','$usuario','$clave','Usuario');"; //Usuario by default

$ejecutar_consulta = mysqli_query($conexion, $consulta_sql);


header("Location: inicio.php");

mysqli_close($conexion);

?>
