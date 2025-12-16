<?php

if (isset($_GET['id_usuario'])) {
    $id = $_GET['id_usuario'];
  
    $consulta_sql = $conexion->query("DELETE FROM usuarios WHERE id_usuario = '$id';");

    $ejecutar_consulta = mysqli_query($conexion, $consulta_sql);
  
    if ($ejecutar_consulta == 0) {
        echo "<div class='alert alert-success'>Usuario eliminado correctamente</div>";
        
    } else {
        echo "<div class='alert alert-warning'> Error, Al eliminar producto</div>";

    }
}
?>
