
<?php
ob_start(); // Inicia el almacenamiento en buffer de la salida
global $conexion;

require "conexion.php";

if (!empty($_POST["btnregistrarProducto"])) {

    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["stock"])) {
        $id = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["id_producto"])));
        $nombre = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["nombre"])));
        $descripcion = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["descripcion"])));
        $precio = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["precio"])));
        $stock = htmlspecialchars(trim(mysqli_real_escape_string($conexion, $_POST["stock"])));

        $consulta_sql = "UPDATE productos SET nombre='$nombre' , descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id_producto=$id";
        $consulta_sql = mysqli_query($conexion, $consulta_sql);

        if ($consulta_sql == 1) {
            echo "<div class='alert alert-success'>  Articulo modificado correctamente. Redirigiendo...</div>";
            echo "<meta http-equiv='refresh' content='2;url=admin_de_productos.php'>"; // Redirige después de 2 segundos
        } else {
            echo "<div class='alert alert-danger'> Error, Al modificar productor</div>";
        }
    } else {
        echo "<div class='alert alert-warning'> Error, falta completar algun campo.</div>";
    }
}

ob_end_flush(); // Envía el contenido del buffer de salida
?>
