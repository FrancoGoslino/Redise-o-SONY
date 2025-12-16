<?php
global $conexion;
session_start();

require "conexion.php";

$usuario = mysqli_real_escape_string($conexion, $_POST ['usuario']);
$clave = mysqli_real_escape_string($conexion, $_POST ['clave']);


$consulta_sql = "SELECT usuario, clave FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave';";

$ejecutar_consulta_sql = mysqli_query($conexion, $consulta_sql);

if(mysqli_num_rows($ejecutar_consulta_sql) > 0){
    $registro = mysqli_fetch_assoc($ejecutar_consulta_sql);

    if($usuario == $registro['usuario'] && $clave == $registro['clave']){
        $_SESSION['nombre_usuario'] = $usuario;
        header("location: index.php");
        exit();
    }else{
        echo "Usuario y/o contraseña incorrecto";
    }
}else{
    echo "No existen registros en la base de datos";
}


// <?php
// session_start();
// include ("conexion.php");

// if (isset($_POST['login'])) {
//     $usuario = $_POST['usuario'];
//     $clave = $_POST['clave'];

//     $result = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'");

//     if (mysqli_num_rows($result) == 1) {
//         $fila = mysqli_fetch_assoc($result);
//         $_SESSION['id_usuario'] = $fila['id_usuario'];
//         header('Location: perfil.php'); // Redirigir al perfil
//     } else {
//         echo "Usuario o contraseña incorrectos.";
//     }
// }
// ?>