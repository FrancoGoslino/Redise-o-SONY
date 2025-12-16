<?php
global $conexion;

require "conexion.php";

if (!empty($_POST["btnregistrar"])) {
    if (
        !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["mail"]) && !empty($_POST["usuario"]) && !empty($_POST["clave"])
        && !empty($_POST["permiso"])
    ) {
        $nombre = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["nombre"])));
        $apellido = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["apellido"])));
        $mail = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["mail"])));
        $usuario = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["usuario"])));
        $clave = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["clave"])));
        $permiso = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["permiso"])));

        $consulta_sql =
            "INSERT INTO usuarios (nombre, apellido, mail, usuario, clave, permiso)
                         VALUES ('$nombre','$apellido','$mail','$usuario','$clave','$permiso');"; //Usuario by default

        $ejecutar_consulta = mysqli_query($conexion, $consulta_sql);

        if($ejecutar_consulta==1){
            echo '<div class="alert alert-success" role="alert">Persona registrada correctamente.</div>';
        }else{
            echo "<div class='alert alert-danger'> Error, falta completar algun campo.</div>";
        }

    } else {
        echo "<div class='alert alert-danger'> Error, falta completar algun campo.</div>";
    }

}






?>