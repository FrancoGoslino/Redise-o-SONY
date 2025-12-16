<?php
session_start();
require_once 'phpControlador/conexion.php';

// Obtener productos del carrito
$productos = [];
$total = 0;

if (!empty($_SESSION['carrito'])) {
    $ids = array_keys($_SESSION['carrito']);
    $placeholders = str_repeat('?,', count($ids) - 1) . '?';
    
    $stmt = $conexion->prepare("
        SELECT p.*, c.nombre as categoria 
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
        WHERE p.id_producto IN ($placeholders)
    ");
    
    $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($producto = $result->fetch_assoc()) {
        $producto['cantidad'] = $_SESSION['carrito'][$producto['id_producto']];
        $producto['subtotal'] = $producto['precio'] * $producto['cantidad'];
        $total += $producto['subtotal'];
        $productos[] = $producto;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container my-5">
        <h1 class="mb-4">Carrito de Compras</h1>
        
        <?php if (empty($productos)): ?>
            <div class="alert alert-info">
                Tu carrito está vacío. <a href="index.php" class="alert-link">Seguir comprando</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= htmlspecialchars($producto['imagen']) ?>" 
                                             alt="<?= htmlspecialchars($producto['nombre']) ?>" 
                                             style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                        <div>
                                            <h6 class="mb-0"><?= htmlspecialchars($producto['nombre']) ?></h6>
                                            <small class="text-muted"><?= htmlspecialchars($producto['categoria']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>$<?= number_format($producto['precio'], 2) ?></td>
                                <td>
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary btn-sm" 
                                                onclick="actualizarCantidad(<?= $producto['id_producto'] ?>, -1)">-</button>
                                        <input type="number" class="form-control form-control-sm text-center" 
                                               value="<?= $producto['cantidad'] ?>" min="1" 
                                               onchange="actualizarCantidad(<?= $producto['id_producto'] ?>, 0, this.value)">
                                        <button class="btn btn-outline-secondary btn-sm" 
                                                onclick="actualizarCantidad(<?= $producto['id_producto'] ?>, 1)">+</button>
                                    </div>
                                </td>
                                <td>$<?= number_format($producto['subtotal'], 2) ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" 
                                            onclick="eliminarDelCarrito(<?= $producto['id_producto'] ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Seguir comprando
                </a>
                <a href="checkout.php" class="btn btn-primary">
                    Proceder al pago <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    async function actualizarCantidad(id, cambio, valor = null) {
        try {
            const cantidad = valor !== null ? parseInt(valor) : 
                           (cambio === 0 ? 1 : Math.max(1, (document.querySelector(`input[onchange*="${id}"]`).value || 0) * 1 + cambio));
            
            const response = await fetch('phpControlador/actualizar_carrito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id_producto: id,
                    cantidad: cantidad
                })
            });

            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.error || 'Error al actualizar el carrito');
            }

            // Recargar la página para ver los cambios
            window.location.reload();

        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Error al actualizar el carrito');
        }
    }

    async function eliminarDelCarrito(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto del carrito?')) {
            try {
                const response = await fetch('phpControlador/eliminar_del_carrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_producto: id
                    })
                });

                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.error || 'Error al eliminar el producto');
                }

                // Recargar la página para ver los cambios
                window.location.reload();

            } catch (error) {
                console.error('Error:', error);
                alert(error.message || 'Error al eliminar el producto');
            }
        }
    }
    </script>
</body>
</html>