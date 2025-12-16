<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include connection using relative path
require_once __DIR__ . '/../conexion.php';

// Check if connection was successful
if (!isset($conexion) || !$conexion) {
    die("Error de conexión con la base de datos");
}

// Verificar si es una petición AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Función para enviar respuesta
function sendResponse($success, $message = '', $data = []) {
    if (!headers_sent()) {
        header('Content-Type: application/json');
    }
    
    $response = [
        'success' => $success,
        'message' => $message,
        'data' => $data
    ];
    
    global $isAjax;
    if (($isAjax ?? false) || !empty($GLOBALS['isAjax'])) {
        echo json_encode($response);
        exit;
    }
    
    return $response;
}

// Verificar si se está enviando el formulario
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = sendResponse(false, 'Método no permitido');
    if (!empty($response)) {
        $_SESSION['error_message'] = $response['message'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    return $response;
}

// Verificar token CSRF
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // Si es una inclusión, lanzar excepción
    if (defined('INCLUDED')) {
        throw new Exception('Token CSRF inválido');
    }
    // Si es una petición directa, enviar respuesta
    sendResponse(false, 'Token CSRF inválido');
}

// Verificar permisos
if (!isset($_SESSION['permiso']) || $_SESSION['permiso'] !== 'admin') {
    // Si es una inclusión, lanzar excepción
    if (defined('INCLUDED')) {
        throw new Exception('No autorizado');
    }
    // Si es una petición directa, enviar respuesta
    sendResponse(false, 'No autorizado');
}

try {
    // Validar campos requeridos
    $required = ['id_producto', 'nombre', 'descripcion', 'precio', 'stock'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("El campo $field es requerido");
        }
    }

    // Obtener y limpiar datos
    $id = intval($_POST['id_producto']);
    $nombre = $conexion->real_escape_string(trim($_POST['nombre']));
    $descripcion = $conexion->real_escape_string(trim($_POST['descripcion']));
    $precio = floatval($_POST['precio']);
    $stock = $conexion->real_escape_string(trim($_POST['stock']));

    // Iniciar la consulta SQL
    $sql = "UPDATE productos SET 
            nombre = '$nombre',
            descripcion = '$descripcion',
            precio = $precio,
            stock = '$stock'";

    // Manejar la imagen si se subió una nueva
    // Handle file upload if a new image was uploaded
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . '/../img/productos/';
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Generate a unique filename
        $file_extension = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        // Move the uploaded file
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            // Delete the old image if it exists
            $sql_select = "SELECT imagen FROM productos WHERE id_producto = $id";
            $result = $conexion->query($sql_select);
            if ($result && $row = $result->fetch_assoc() && !empty($row['imagen'])) {
                $old_image = __DIR__ . '/../' . ltrim($row['imagen'], '/');
                if (file_exists($old_image)) {
                    @unlink($old_image); // @ to suppress errors if file doesn't exist
                }
            }
            
            $imagen_path = 'img/productos/' . $new_filename;
            $sql .= ", imagen = '$imagen_path'";
        }
    }

    $sql .= " WHERE id_producto = $id";

    // Ejecutar la consulta
    if ($conexion->query($sql)) {
        if ($isAjax) {
            sendResponse(true, 'Producto actualizado correctamente');
        } else {
            $_SESSION['success_message'] = 'Producto actualizado correctamente. Redirigiendo...';
            header('Location: admin_de_productos.php');
            exit;
        }
    } else {
        throw new Exception('Error al actualizar el producto: ' . $conexion->error);
    }

} catch (Exception $e) {
    sendResponse(false, $e->getMessage());
}

$conexion->close();
if (ob_get_level() > 0) {
    ob_end_flush();
}