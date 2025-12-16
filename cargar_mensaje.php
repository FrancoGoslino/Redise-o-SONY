<?php
global $conexion;
require_once "iniciar_sesion.php";
require_once "conexion.php";
require_once "../seguridad.php";
$nombre = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["nombre"])));
$mail = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["mail"])));
$titulo_mensaje = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["titulo_mensaje"])));
$mensaje = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["mensaje"])));


$consulta_sql =
    "INSERT INTO mensajeria (nombre, mail, titulo_mensaje, mensaje)
                VALUES ('$nombre','$mail','$titulo_mensaje','$mensaje');";

$ejecutar_consulta = mysqli_query($conexion, $consulta_sql);

header("Location: index.php");

mysqli_close($conexion);

