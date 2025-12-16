<?php
ob_start(); // Inicia el almacenamiento en buffer de la salida
global $conexion;

require "conexion.php";

if (!empty($_POST["btnregistrar"])) {

    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["mail"]) && !empty($_POST["usuario"]) && !empty($_POST["clave"]) && !empty($_POST["permiso"])) {
        $id = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["id_usuario"])));
        $nombre = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["nombre"])));
        $apellido = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["apellido"])));
        $mail = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["mail"])));
        $usuario = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["usuario"])));
        $clave = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["clave"])));
        $permiso = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["permiso"])));

        $consulta_sql = "UPDATE usuarios SET nombre='$nombre' , apellido='$apellido', mail='$mail', usuario='$usuario', clave='$clave', permiso='$permiso' WHERE id_usuario=$id";
        $consulta_sql = mysqli_query($conexion, $consulta_sql);

        if ($consulta_sql == 1) {
            echo "<div class='alert alert-success'>  Usuario modificado correctamente. Redirigiendo...</div>";
            echo "<meta http-equiv='refresh' content='2;url=admin_de_usuarios.php'>"; // Redirige después de 2 segundos
        } else {
            echo "<div class='alert alert-danger'> Error, Al modificar productor</div>";
        }
    } else {
        echo "<div class='alert alert-warning'> Error, falta completar algun campo.</div>";
    }
}

ob_end_flush(); // Envía el contenido del buffer de salida
?>