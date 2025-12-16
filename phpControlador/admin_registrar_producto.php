<?php

session_start();
// Validate CSRF token
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || 
        $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Error de seguridad: Token CSRF inválido');
    }
}

global $conexion;

require "conexion.php";

if (!empty($_POST["btnregistrarProducto"])) {
    if (
        !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["stock"])
    ) {
        $nombre = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["nombre"])));
        $descripcion = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["descripcion"])));
        $precio = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["precio"])));
        $stock = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["stock"])));
        

        $consulta_sql =
            "INSERT INTO productos (nombre, descripcion, precio, stock)
                         VALUES ('$nombre','$descripcion','$precio','$stock');";

        $ejecutar_consulta = mysqli_query($conexion, $consulta_sql);

        if($ejecutar_consulta==1){
            echo '<div class="alert alert-success" role="alert">Producto registrado correctamente.</div>';
        }else{
            echo "<div class='alert alert-danger'> Error, falta completar algun campo.</div>";
        }

    } else {
        echo "<div class='alert alert-danger'> Error, falta completar algun campo.</div>";
    }

}
