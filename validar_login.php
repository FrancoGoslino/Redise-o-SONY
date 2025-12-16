<?php
session_start();
include ("conexion.php");

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$clave = mysqli_real_escape_string($conexion, $_POST['clave']);

// Modifico la consulta para obtener todos los campos necesarios
$consulta_sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$ejecutar_consulta_sql = mysqli_query($conexion, $consulta_sql);

if (mysqli_num_rows($ejecutar_consulta_sql) == 1) {
    $registro = mysqli_fetch_assoc($ejecutar_consulta_sql);

    // Guardo todos los datos necesarios en la sesión
    $_SESSION['id_usuario'] = $registro['id_usuario'];
    $_SESSION['usuario'] = $registro['usuario'];
    $_SESSION['nombre'] = $registro['nombre'];
    $_SESSION['apellido'] = $registro['apellido'];
    $_SESSION['mail'] = $registro['mail'];
    $_SESSION['permiso'] = $registro['permiso'];
    
    header("Location: index.php");
    exit();
} else {
    echo "Usuario y/o contraseña incorrectos o no existen registros en la base de datos";
}
?>