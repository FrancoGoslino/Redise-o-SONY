<?php

if (isset($_GET['id_producto'])) {
    $id = $_GET['id_producto'];
  
    $consulta_sql = $conexion->query("DELETE FROM productos WHERE id_producto = '$id';");

    $ejecutar_consulta = mysqli_query($conexion, $consulta_sql);
  
    if ($ejecutar_consulta == 0) {
        echo "<div class='alert alert-success'>producto eliminado correctamente</div>";
        
    } else {
        echo "<div class='alert alert-warning'> Error, Al eliminar producto</div>";

    }
}
?>
