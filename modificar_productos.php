<!DOCTYPE html>
<?php
session_start();
include "conexion.php";
require "phpControlador/permisos_vistas.php";

if (isset($_GET['id_producto'])) {
  $id = $_GET['id_producto'];

  $sql = $conexion->query("SELECT * FROM productos WHERE id_producto = '$id';");
} else {
  echo "Error: ID de producto no proporcionado.";
  exit; // Termina el script si no hay ID de usuario.
}
?>

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
  <!-- NAV BAR -->
  <header>
    <section>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 1001;">
        <!-- opciones perfil -->
        <div class="container-fluid" id="containerPerfil">
          <div class="interior">
            <a class="navbar-brand" class="btn" href="#open-modal"><img src="img/perfil.png" alt="50" height="40px"></a>
            <div id="open-modal" class="modal-window">
              <div class="boxPerfil">
                <a href="#" title="Close" class="modal-close">Cerrar</a>
                <h1>Nombre del Usuario</h1>
                <p class="claseTarjeta">Permisos: Administrador</p>
                <div>
                  <img class="fotoPerfil" height="150px"
                    src="https://i.pinimg.com/originals/42/11/4c/42114cb0d582fb35b2f005bb1880e11b.jpg" alt="" />
                  <h3>Datos del usuario</h3>
                  <p class="datosTarjeta">Nombre</p>
                  <h6>Nombre del Usuario</h6>
                  <p class="datosTarjeta">Apellido</p>
                  <h6>Apellido del Usuario</h6>
                  <p class="datosTarjeta">Correo</p>
                  <h6>correo@ejemplo.com</h6>
                  <a href="cerrar_sesion.php" title="Cerrar sesion" class="modal-close-session">Cerrar sesion</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- cierre opciones perfil -->

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
              <a class="nav-link" href="capitulos.html"><img src="img/carrito.png" alt="50" height="30px"></a>
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
  <!-- MENU HABURGUESA - Offcanvas -->
  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdrop">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menu de opciones</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <nav aria-label="a">
        <div><a class="nav-link" href="index.php">Home</a></div>
        <?php if ($fila["permiso"] === "admin"): ?>
          <div>
            <a class="nav-link" href="admin_de_usuarios.php">Usuarios</a>
          </div>
          <div><a class="nav-link" href="admin_de_productos.php">Productos</a></div>

        <?php endif; ?>
        <div><a class="nav-link" href="admin_de_productos.php">Carrito</a></div>
        <div><a class="nav-link" href="admin_de_productos.php">FAQS</a></div>
      </nav>
    </div>
  </div>

  <!-- CONTENIDO PRINCIPAL -->
  <h1 class="text-center p-3"> Modificar productos</h1>
  <form class="col-4 p-3 m-auto" method="POST">
    <input type="hidden" name="id_producto" value="<?php echo $_GET["id_producto"] ?>">
    <?php
    include "phpControlador/modificar_producto.php";

    while ($datos = $sql->fetch_object()) { ?>
      
      <h3 class="text-center text-secondary">Registro de Prodcutos</h3>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nombre del articulo</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datos->nombre; ?>">
      </div>
      <div class="mb-3 messageBox">
        <label for="exampleInputEmail1" class="form-label">Descripcion</label>
        <textarea type="text" class="form-control" name="descripcion"><?php echo $datos->descripcion; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Precio</label>
        <input type="number" class="form-control" name="precio" value="<?php echo $datos->precio; ?>">
      </div>
      <div class="mb-3">
        <label for="permiso" class="form-label">Stock</label>
        <select type="text" class="form-control" id="permiso" name="stock" required>
          <option value="Disponible" <?php if ($datos->stock == 'Disponible')
            echo 'selected'; ?>>Disponible</option>
          <option value="Agotado" <?php if ($datos->stock== 'Agotado')
            echo 'selected'; ?>>Agotado</option>
        </select>
      </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary" name="btnregistrarProducto" value="ok">Guardar</button>
  </form>



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>