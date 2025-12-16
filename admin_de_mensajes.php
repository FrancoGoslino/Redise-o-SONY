<!DOCTYPE html>
<?php
session_start();

// Generate CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Include database connection
include "conexion.php";
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
  <script> function eliminar() {
      var respuesta = confirm("Estas seguro que deseas eliminar el articulo?");
      return respuesta
    } </script>
  <!-- NAV BAR -->
  <!-- PERFIL -->
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
  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdrop">
    <div class="text-center w-100">
      <img src="https://logodownload.org/wp-content/uploads/2014/02/sony-logo-3.png" class="img-fluid"
        alt="Imagen del menu">
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
      <!-- Opciones del menú con mayor espacio entre ellas -->
      <nav aria-label="a">
        <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_usuarios.php"></a></div>
        <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">Home</a></div>
        <?php if ($fila["permiso"] === "admin"): ?>
          <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_usuarios.php">Usuarios</a></div>
          <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_productos.php">Productos</a></div>
          <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_mensajes.php">Mensajeria</a></div>
        <?php endif; ?>
        <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">Carrito</a></div>
        <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">FAQS</a></div>
      </nav>
      <!-- Opción centrada con tipografía más pequeña, abajo de todo -->
      <div class="mb-4 text-center w-100">
        <a class="nav-link " href="cerrar_sesion.php" title="Cerrar sesion" class="modal-close-session"
          style="font-size: smaller;">Cerrar sesion</a>
        </a>
      </div>
    </div>
  </div>


  <!-- CONTENIDO PRINCIPAL -->
  <h1 class="text-center p-3">Buzon de mensajes</h1>

  <div class="center p-3">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Usuario</th>
          <th scope="col">Mail</th>
          <th scope="col">Titulo</th>
          <th scope="col">Mensaje</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "conexion.php";

        $consulta = $conexion->query("SELECT * FROM mensajeria");
        while ($datos = $consulta->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $datos["id_mensaje"]; ?></td>
            <td><?php echo $datos["nombre"]; ?></td>
            <td><?php echo $datos["mail"]; ?></td>
            <td><?php echo $datos["titulo_mensaje"]; ?></td>
            <td><?php echo $datos["mensaje"]; ?></td>


          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>