<?php
// Verificar si la página actual requiere autenticación
$pagina_actual = basename($_SERVER['PHP_SELF']);
$paginas_sin_autenticacion = ['index.php', 'registro.php', 'validar_login.php'];

// Si la página actual no está en la lista de páginas sin autenticación
if (!in_array($pagina_actual, $paginas_sin_autenticacion)) {
    // Verificar si el usuario no ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: index.php');
        exit();
    }
    
    // Si el usuario está autenticado, obtener sus datos de la sesión
    $fila = [
        'id_usuario' => $_SESSION['id_usuario'],
        'usuario' => $_SESSION['usuario'],
        'nombre' => $_SESSION['nombre'],
        'apellido' => $_SESSION['apellido'],
        'mail' => $_SESSION['mail'],
        'permiso' => $_SESSION['permiso']
    ];
    
    // Crear la variable $datos para compatibilidad con el código existente
    $datos = implode('||', [
        $fila['id_usuario'],
        $fila['nombre'],
        $fila['apellido'],
        $fila['mail'],
        $fila['usuario'],
        '', // Dejamos la clave vacía por seguridad
        $fila['permiso']
    ]);
}
?>