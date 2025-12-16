<?php
session_start();
include "conexion.php";
require "phpControlador/permisos_vistas.php";
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "phpControlador/modificar_producto.php";
    exit;
}
if (!isset($_GET['id_producto'])) {
    $_SESSION['error_message'] = "Error: ID de producto no proporcionado.";
    header('Location: admin_de_productos.php');
    exit;
}
$id = intval($_GET['id_producto']);
$sql = $conexion->query("SELECT * FROM productos WHERE id_producto = '$id'");
if (!$sql || $sql->num_rows === 0) {
    $_SESSION['error_message'] = "Producto no encontrado.";
    header('Location: admin_de_productos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra Lateral Responsiva</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="css/modal.css" />
  <link rel="stylesheet" href="css/modal_Menu.css" />
  <link rel="stylesheet" href="css/cards.css" />
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
  <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>

  <style>
    body {
      background: none;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: fixed;
      left: 0;
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

    .sidebar a:hover {
      background-color: #575d63;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .sidebar a {
        float: left;
      }

      .sidebar a:last-child {
        border-bottom: none;
      }
    }

    @media (max-width: 768px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }

    .form-container {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .form-container h2 {
      margin-bottom: 20px;
    }



    .password-cell {
      font-family: 'password';
    }

    @font-face {
      font-family: 'password';
      src: local('Arial');
      unicode-range: U+0020-007E;
      /* Solo se aplica a caracteres ASCII */
    }

    .password-cell::before {
      content: '•';
      letter-spacing: 2px;
    }

    .password-cell::after {
      content: attr(data-password);
      visibility: hidden;
      position: absolute;
    }
  </style>
</head>

<body id="body-admin">
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
    body {
      background: none;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: fixed;
      left: 0;
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

    .sidebar a:hover {
      background-color: #575d63;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .sidebar a {
        float: left;
      }

      .sidebar a:last-child {
        border-bottom: none;
      }
    }

    @media (max-width: 768px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }

    .form-container {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .form-container h2 {
      margin-bottom: 20px;
    }



    .password-cell {
      font-family: 'password';
    }

    @font-face {
      font-family: 'password';
      src: local('Arial');
      unicode-range: U+0020-007E;
      /* Solo se aplica a caracteres ASCII */
    }

    .password-cell::before {
      content: '•';
      letter-spacing: 2px;
    }

    .password-cell::after {
      content: attr(data-password);
      visibility: hidden;
      position: absolute;
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

  <!-- CONTENIDO PRINCIPAL -->
  <div class="container mt-4">
    <?php if (isset($_SESSION['error_message'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php 
          echo $_SESSION['error_message'];
          unset($_SESSION['error_message']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    
    <h1 class="text-center p-3">Modificar producto</h1>
    <form class="col-md-8 col-lg-6 mx-auto p-4 bg-light rounded shadow" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?php echo $id; ?>">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); ?>">
        
        <?php while ($datos = $sql->fetch_object()): ?>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del artículo</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($datos->nombre); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3"><?php echo htmlspecialchars($datos->descripcion); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" value="<?php echo htmlspecialchars($datos->precio); ?>" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Estado de stock</label>
            <select class="form-control" id="stock" name="stock" required>
                <option value="Disponible" <?php echo ($datos->stock == 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                <option value="Agotado" <?php echo ($datos->stock == 'Agotado') ? 'selected' : ''; ?>>Agotado</option>
            </select>
        </div>
        <div class="mb-3">
          <label for="imagen" class="form-label">Imagen del producto</label>
          <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
            <?php if (!empty($datos->imagen)): ?>
                <div class="mt-2">
                    <small>Imagen actual:</small><br>
                    <img src="<?php echo htmlspecialchars($datos->imagen); ?>" alt="Imagen actual" style="max-width: 200px; max-height: 200px;">
                </div>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="admin_de_productos.php" class="btn btn-secondary me-md-2">Cancelar</a>
            <button type="submit" class="btn btn-primary" name="btnregistrarProducto" value="ok">
                <i class="fas fa-save me-1"></i> Guardar cambios
            </button>
        </div>
    </form>
</div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>