<?php
session_start();
require_once __DIR__ . '/conexion.php';

header('Content-Type: application/json');

// Verificar si la petición es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

// Obtener datos del cuerpo de la petición
$input = json_decode(file_get_contents('php://input'), true);
$id_producto = $input['id_producto'] ?? null;
$cantidad = $input['cantidad'] ?? 1;

// Validar datos
if (!$id_producto || !is_numeric($id_producto) || $cantidad < 1) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    exit;
}

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar o actualizar producto en el carrito
if (isset($_SESSION['carrito'][$id_producto])) {
    $_SESSION['carrito'][$id_producto] += $cantidad;
} else {
    $_SESSION['carrito'][$id_producto] = $cantidad;
}

// Obtener información del producto para la respuesta
$stmt = $conexion->prepare("SELECT id_producto, nombre, precio FROM productos WHERE id_producto = ?");
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if ($producto) {
    echo json_encode([
        'success' => true,
        'carrito' => [
            'total_items' => array_sum($_SESSION['carrito']),
            'items' => $_SESSION['carrito']
        ],
        'producto' => $producto
    ]);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Producto no encontrado']);
}
