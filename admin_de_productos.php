<?php
session_start();
// Generate CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Include database connection
include "conexion.php";




// Manejar eliminación de producto
if (isset($_GET['eliminar'])) {
    $id_eliminar = intval($_GET['eliminar']);
    $query_eliminar = "DELETE FROM productos WHERE id_producto = $id_eliminar";
    if ($conexion->query($query_eliminar)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Error al eliminar el producto: " . $conexion->error;
    }
}
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnregistrarProducto'])) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Error de seguridad: Token CSRF inválido');
    }

    // Get form data
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $stock = $_POST['stock'] === 'user' ? 'Disponible' : 'Agotado';

    // Handle file upload
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "img/productos/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen = $target_file;
        }
    }

    // Insert into database
    $query = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen) 
              VALUES ('$nombre', '$descripcion', $precio, '$stock', '$imagen')";
    
    if ($conexion->query($query)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Error al registrar el producto: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/modal_Menu.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
    <style>
        body { background: none; }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
        }
        .sidebar a:hover { background-color: #575d63; }
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .sidebar a { text-align: center; float: none; }
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .password-cell { font-family: 'password'; }
        @font-face {
            font-family: 'password';
            src: local('Arial');
            unicode-range: U+0020-007E;
        }
        .password-cell::before {
            content: '•';
            letter-spacing: 2px;
        }
    </style>
</head>
<!-- NAV BAR -->
<header>
    <section>
      <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- opciones perfil -->
        <div class="container-fluid" id="containerPerfil">
          <div class="interior">
            <a class="navbar-brand" class="btn" href="#open-modal"><img src="img\perfil.png" alt="50" height=40px></a>
            <div id="open-modal" class="modal-window">
              <div class="boxPerfil">
                <a href="#" title="Close" class="modal-close"><img src="https://cdn-icons-png.flaticon.com/512/54/54972.png" width="20"></a>
                <h1><?php echo $fila["usuario"] ?></h1>
                <p class="claseTarjeta">Permisos: <?php echo $fila["permiso"]; ?> </p>
                <div>
                  <img class="fotoPerfil" height="150px"
                    src="https://cdn-icons-png.freepik.com/512/1077/1077063.png" alt="" />
                  <h3>Datos del usuario</h3>
                  <p class="datosTarjeta">Nombre: <?php echo $fila["nombre"]; ?></p>
                  <p class="datosTarjeta">Apellido: <?php echo $fila["apellido"]; ?></p>
                  <p class="datosTarjeta">Correo: <?php echo $fila["mail"]; ?></p>
                  <a href="cerrar_sesion.php" title="Cerrar sesion" class="modal-close-session">Cerrar sesion</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button><!-- cierre opciones perfil --><!-- cierre opciones perfil -->

        <!-- OPCIONES MENU -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_de_usuarios.php">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_de_productos.php">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_de_mensajes.php"><img src="img/carrito.png" alt="50" height="30px"></a>
            </li>
            <!-- menu hamburguesa -->
            <li class="nav-item">
              <a href="" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <img src="img/PRODUCTOS/menu-hamburguesa.png" alt="50" height="40px"></a>
            </li>
          </ul>
        </div>
      </nav>
    </section>
  </header>

<!-- MENU HAMBURGUESA - Offcanvas -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">
    <div class="text-center w-100">
        <img src="https://logodownload.org/wp-content/uploads/2014/02/sony-logo-3.png" class="img-fluid"
            alt="Logo Sony">
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <nav aria-label="Menú principal">
            <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_usuarios.php"></a></div>
            <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">Home</a></div>
            <?php if (isset($_SESSION['permiso']) && $_SESSION['permiso'] === 'admin'): ?>
                <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_usuarios.php">Usuarios</a></div>
                <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_productos.php">Productos</a></div>
                <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_mensajes.php">Mensajería</a></div>
            <?php endif; ?>
            <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">Carrito</a></div>
            <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">FAQS</a></div>
        </nav>
        <div class="mb-4 text-center w-100">
            <a class="nav-link" href="cerrar_sesion.php" title="Cerrar sesión" style="font-size: smaller;">
                Cerrar sesión
            </a>
        </div>
    </div>
</div>

<body id="body-admin">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <?php 
                echo $_SESSION['success_message'];
                unset($_SESSION['success_message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            // Redirigir después de 2 segundos
            setTimeout(function() {
                window.location.href = 'admin_de_productos.php';
            }, 2000);
        </script>
    <?php endif; ?>
    
    <script>
        function eliminar() {
            return confirm("¿Estás seguro que deseas eliminar el producto?");
        }
    </script>

    <!-- Main Content -->
    <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">
            <!-- Add Product Form -->
            <div class="col-md-4">
              <form method="POST" enctype="multipart/form-data" class="form-container">
                  <h3 class="text-center text-secondary mb-4">Registro de Productos</h3>
                  
                  <!-- CSRF Token -->
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                  
                  <div class="mb-3">
                      <label class="form-label">Nombre del artículo</label>
                      <input type="text" class="form-control" name="nombre" required>
                  </div>
                  
                  <div class="mb-3">
                      <label class="form-label">Descripción</label>
                      <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                  </div>
                  
                  <div class="mb-3">
                      <label class="form-label">Precio</label>
                      <input type="number" step="0.01" class="form-control" name="precio" required>
                  </div>
                  
                  <div class="mb-3">
                      <label class="form-label">Imagen</label>
                      <input type="file" class="form-control" name="imagen" accept="image/*" required>
                  </div>
                  
                  <div class="mb-3">
                      <label class="form-label">Estado</label>
                      <select class="form-select" name="stock" required>
                          <option value="Disponible">Disponible</option>
                          <option value="Agotado">Agotado</option>
                      </select>
                  </div>
                  
                  <button type="submit" name="btnregistrarProducto" class="btn btn-primary w-100">
                      Registrar Producto
                  </button>
              </form>
          </div>

            <!-- Products Table -->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $query_productos = "SELECT * FROM productos";
                              $result_productos = $conexion->query($query_productos);
                              while ($producto = $result_productos->fetch_assoc()):
                              ?>
                                  <tr>
                                      <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                                      <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                      <td>
                                          <?php if (!empty($producto['imagen'])): ?>
                                              <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                                  alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                                                  style="width: 50px; height: 50px; object-fit: cover;">
                                          <?php else: ?>
                                              <span class="text-muted">Sin imagen</span>
                                          <?php endif; ?>
                                      </td>
                                      <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                      <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                      <td>
                                          <span class="badge bg-<?php echo $producto['stock'] === 'Disponible' ? 'success' : 'danger'; ?>">
                                              <?php echo htmlspecialchars($producto['stock']); ?>
                                          </span>
                                      </td>
                                      <td>
                                        <a href="modificar_productos.php?id_producto=<?php echo $producto['id_producto']; ?>" 
                                          class="btn btn-sm btn-warning" 
                                          title="Editar producto">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="?eliminar=<?php echo $producto['id_producto']; ?>" 
                                          class="btn btn-sm btn-danger" 
                                          onclick="return confirm('¿Estás seguro de eliminar este producto?')"
                                          title="Eliminar producto">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                  </tr>
                              <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
      // Función para cargar los datos del producto en el modal de edición
      function cargarDatosProducto(producto) {
          document.getElementById('editar_id_producto').value = producto.id_producto;
          document.getElementById('editar_nombre').value = producto.nombre;
          document.getElementById('editar_descripcion').value = producto.descripcion;
          document.getElementById('editar_precio').value = producto.precio;
          document.getElementById('editar_stock').value = producto.stock;
          
          // Mostrar imagen actual si existe
          const imgElement = document.getElementById('editar_imagen_actual');
          if (producto.imagen) {
              imgElement.src = producto.imagen;
              imgElement.style.display = 'block';
          } else {
              imgElement.style.display = 'none';
          }
      }
      
      </script>
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
</body>
</html>
<?php
// Close database connection
$conexion->close();

// Limpiar el mensaje de éxito después de mostrarlo
if (isset($_SESSION['success_message'])) {
    unset($_SESSION['success_message']);
}
?>