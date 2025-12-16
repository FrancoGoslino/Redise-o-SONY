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
    
    <style>
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
            .sidebar a {float: left;}
            .sidebar a:last-child {border-bottom: none;}
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
    </style>
</head>
<body>
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
                    <img class="fotoPerfil" height="150px" src="https://i.pinimg.com/originals/42/11/4c/42114cb0d582fb35b2f005bb1880e11b.jpg" alt="" />
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
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation">
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
                <a class="nav-link" href="capitulos.html"><img src="img/carrito.png" alt="50" height="30px"></a>
              </li>
              <!-- menu hamburguesa -->
              <div class="container-fluid" id="containerPerfil">
                <div class="interior">
                  <a class="navbar-brand" href="#open-modal-menu"><img src="img/PRODUCTOS/menu-hamburguesa.png" alt="50" height="40px"></a>
                  <div id="open-modal-menu" class="modal-window-menu">
                    <div class="boxPerfil">
                      <a href="#" title="Close" class="modal-close">Cerrar</a>
                      <h1>Opciones</h1>
                      <div class="datos_menu_tarjeta">
                        <li><a class="nav-link" href="productos.php">Usuarios</a></li>
                        <li><a class="nav-link" href="configuracion.php">Configuración</a></li>
                        <li><a class="nav-link" href="ayuda.php">Ayuda</a></li>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button><!-- cierre menu hamburguesa -->
            </ul>
          </div>
        </nav>
      </section>
    </header>


      <!-- SIDEBAR -->
    <div class="sidebar" style="z-index: 1000;">
        <h3>Gestion Usuarios</h3>
            <a class="nav-link" href="admin-crear.php">Crear</a>
            <a class="nav-link" href="xd.php">Modificar</a>
        <h3>Gestion Productos</h3>
            <a class="nav-link" href="admin-crear.php">Crear</a>
            <a class="nav-link" href="admin-modificar.php">Modificar</a>
    </div>


    <!-- CONTENIDO PRINCIPAL -->
    <div class="content" style="margin-left: 250px; padding: 20px;">
      <div class="form-container">
        <h2>Alta usuarios</h2>
        <form action="admin-registrar.php" method="POST">
          <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
          </div>
          <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="apellido" required>
          </div>
          <div class="mb-3">
              <label for="mail" class="form-label">Mail</label>
              <input type="email" class="form-control" id="mail" name="mail" placeholder="mail" required>
          </div>
          <div class="mb-3">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" required>
          </div>
          <div class="mb-3">
              <label for="clave" class="form-label">Clave</label>
              <input type="text" class="form-control" id="clave" name="clave" placeholder="clave" required>
          </div>
          <div class="mb-3">
              <label for="permiso" class="form-label">Permiso</label>
              <select class="form-control" id="permiso" name="permiso" placeholder="permiso" required>
                  <option value="user">Usuario</option>
                  <option value="admin">Administrador</option>
              </select>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Crear</button>
          </div>
          <!-- Modal desplegado por button-->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo usuario</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Deseas guardar los cambios?</div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-success">Crear</button>
                      </div>
                  </div>
              </div>
          </div>
        </form>
      </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
