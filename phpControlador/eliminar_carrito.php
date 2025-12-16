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

// Validar datos
if (!$id_producto || !is_numeric($id_producto)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'ID de producto inválido']);
    exit;
}

// Verificar si el producto está en el carrito
if (isset($_SESSION['carrito'][$id_producto])) {
    // Eliminar el producto del carrito
    unset($_SESSION['carrito'][$id_producto]);
    
    echo json_encode([
        'success' => true,
        'carrito' => [
            'total_items' => array_sum($_SESSION['carrito']),
            'items' => $_SESSION['carrito']
        ]
    ]);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Producto no encontrado en el carrito']);
}