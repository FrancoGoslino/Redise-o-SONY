<?php
require_once dirname(__DIR__) . "/conexion.php";
// Ensure no output has been sent
if (headers_sent()) {
    die('Error: Headers already sent');
}

// Clear any previous output
while (ob_get_level()) ob_end_clean();

// Start output buffering
ob_start();

// Disable error display but log them
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Function to send JSON response
function sendJsonResponse($data, $statusCode = 200) {
    // Clear any output
    while (ob_get_level()) ob_end_clean();
    
    // Set headers
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    
    // Output JSON
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

try {
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    // Check database connection
    if (!isset($conexion) || !$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    // Query to get products
    $query = "SELECT * FROM productos";
    $result = $conexion->query($query);
    
    if ($result === false) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $imagen = !empty($row['imagen']) ? $row['imagen'] : 'img/productos/default.jpg';
        if (!file_exists($imagen) && $imagen !== 'img/productos/default.jpg') {
            $imagen = 'img/productos/default.jpg';
        }
        
        $productos[] = [
            'id' => (int)$row['id_producto'],
            'nombre' => htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8'),
            'descripcion' => htmlspecialchars($row['descripcion'] ?? '', ENT_QUOTES, 'UTF-8'),
            'precio' => (float)$row['precio'],
            'imagen' => $imagen
        ];
    }
    
    sendJsonResponse([
        'success' => true,
        'data' => $productos
    ]);

} catch (Exception $e) {
    error_log('Error en obtener_productos.php: ' . $e->getMessage());
    sendJsonResponse([
        'success' => false,
        'error' => 'Error al cargar los productos: ' . $e->getMessage()
    ], 500);
}

// Close database connection if it exists
if (isset($conexion) && $conexion) {
    $conexion->close();
}

// Ensure no extra output
while (ob_get_level()) {
    ob_end_clean();
}
exit;