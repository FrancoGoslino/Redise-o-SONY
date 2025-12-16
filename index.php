<?php
session_start();
include_once "conexion.php";
// Verificar si el usuario está autenticado
if (isset($_SESSION['id_usuario'])) {
    // Cargar los datos del usuario desde la sesión
    $fila = [
        'id_usuario' => $_SESSION['id_usuario'],
        'usuario' => $_SESSION['usuario'],
        'nombre' => $_SESSION['nombre'],
        'apellido' => $_SESSION['apellido'],
        'mail' => $_SESSION['mail'],
        'permiso' => $_SESSION['permiso']
    ];
}
// Incluir el controlador de permisos después de definir $fila
require_once "phpControlador/permisos_vistas.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>REDISEÑO SONY</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!-- Hojas de css -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="css/modal.css" />
  <link rel="stylesheet" href="css/modal_Menu.css" />
  <link rel="stylesheet" href="css/cards.css" />
  <style>
    .footer-form {
      max-width: 600px;
      margin: 0 auto;
    }

    .footer-form input,
    .footer-form textarea,
    .footer-form button {
      width: 100%;
      margin-bottom: 15px;
    }

    .footer-form .form-row {
      display: flex;
      flex-direction: row;
      gap: 10px;
    }

    .footer-form .form-row input {
      flex: 1;
    }
  </style>
</head>

<body>
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
                <?php if (isset($_SESSION['id_usuario']) && isset($fila) && is_array($fila)): ?>
                  <h1><?php echo htmlspecialchars($fila["usuario"]) ?></h1>
                  <p class="claseTarjeta">Permisos: <?php echo htmlspecialchars($fila["permiso"]); ?> </p>
                  <div>
                    <img class="fotoPerfil" height="150px"
                      src="https://cdn-icons-png.freepik.com/512/1077/1077063.png" alt="Foto de perfil" />
                    <h3>Datos del usuario</h3>
                    <p class="datosTarjeta">Nombre: <?php echo htmlspecialchars($fila["nombre"]); ?></p>
                    <p class="datosTarjeta">Apellido: <?php echo htmlspecialchars($fila["apellido"]); ?></p>
                    <p class="datosTarjeta">Correo: <?php echo htmlspecialchars($fila["mail"]); ?></p>
                    <a href="cerrar_sesion.php" title="Cerrar sesion" class="modal-close-session">Cerrar sesión</a>
                  </div>
                <?php else: ?>
                  <h2>Iniciar sesión</h2>
                  <div class="text-center mt-4">
                    <p>Para ver tu perfil, por favor inicia sesión</p>
                    <a href="index.php" class="btn btn-primary">Iniciar sesión</a>
                  </div>
                <?php endif; ?>
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
              <a class="nav-link" href="index.php">Tienda</a>
            </li>
            <?php if (isset($fila) && is_array($fila) && isset($fila["permiso"]) && $fila["permiso"] === "admin"): ?>
              <li class="nav-item">
                <a class="nav-link" href="admin_de_usuarios.php">Usuarios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_de_productos.php">Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_de_mensajes.php">Mensajeria</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php"><img src="img\carrito.png" alt="50" height=30px></a>
            </li>
            <!-- BOTON HABURGUESA -->
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
  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdrop">
    <div class="text-center w-100">
      <img src="https://logodownload.org/wp-content/uploads/2014/02/sony-logo-3.png" class="img-fluid" alt="foto del menu">
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
      <!-- Opciones del menú con mayor espacio entre ellas -->
      <nav aria-label="a">
        <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_usuarios.php"></a></div>
        <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">Home</a></div>
        <?php if (isset($_SESSION['id_usuario']) && isset($fila) && is_array($fila) && $fila["permiso"] === "admin"): ?>
          <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_usuarios.php">Usuarios</a></div>
          <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_productos.php">Productos</a></div>
          <div class="mb-4 text-center w-100"><a class="nav-link" href="admin_de_mensajes.php">Mensajería</a></div>
        <?php endif; ?>
        <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">Carrito</a></div>
        <div class="mb-4 text-center w-100"><a class="nav-link" href="index.php">FAQS</a></div>
      </nav>
      <?php if (isset($_SESSION['id_usuario'])): ?>
        <div class="mb-4 text-center w-100">
          <a class="nav-link" href="cerrar_sesion.php" title="Cerrar sesión" style="font-size: smaller;">Cerrar sesión</a>
        </div>
      <?php else: ?>
        <div class="mb-4 text-center w-100">
          <a class="nav-link" href="index.php" title="Iniciar sesión" style="font-size: smaller;">Iniciar sesión</a>
        </div>
      <?php endif; ?>
    </div>
  </div>



  <!-- NOTIFICACION LOGUEO -->
  <div class=notificacion_logueo_exitoso>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      Bienvenido <strong> <?php echo htmlspecialchars($_SESSION["usuario"]) ?>!</strong> Has iniciado sesión exitosamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>

  <!-- BANNER -->
  <div class="banner">
    <img src="img\banner auriculares sony.jpg" class="imgbanner" alt=400px height=920px width=1920px>
  </div>


  <!-- CARD -->
  <div class=contenedor_cards>
    <div class="album py-5 bg-body-tertiary">
      <div class=container>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
          <!---->
          <div class="col">
            <div id=container_hover class="card shadow-sm">
                <img id=imagen_tarjetas src="img\auriculares.png" class="bd-placeholder-img card-img-top"
                  alt=" "></img>
              <p>Audio</p>
            </div>
          </div>
          <!---->
          <div class="col">
            <div id=container_hover class="card shadow-sm">
              <img id=imagen_tarjetas src="img\camara.png" class="bd-placeholder-img card-img-top" alt=" "></img>
              <p>Fotografía</p>
            </div>
          </div>
          <!---->
          <div class="col">
            <div id=container_hover class="card shadow-sm">
              <img id=imagen_tarjetas src="img\televisor.png" class="bd-placeholder-img card-img-top" alt=" "></img>
              <p>Televisión</p>
            </div>
          </div>
          <!---->
          <div class="col">
            <div id=container_hover class="card shadow-sm">
              <img id=imagen_tarjetas src="img\joystick.png" class="bd-placeholder-img card-img-top" alt=" "></img>
              <p>Gaming</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- PRODUCTOS DESTACADOS-->
  <div class="linea">
    <div>
      <h1> PRODUCTOS DESTACADOS</h1>
    </div>
    <div id=contenedor_destacados class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-5">
        <div class="col">
          <div class="card shadow-sm">
            <a href="audio.php"><img src="img\productos\auriculares_vincha.png" class="bd-placeholder-img card-img-top"
                alt=" "></img></a>
            <div class="card-body">
              <h1> JB - 2 Bluetooth</h1>
              <p class="card-text">Auriculares resistentes a prueba de agua y polvo, con el mejor sonido y aislante del mercado.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">$49.999</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><img src="img\carrito.png" alt="50" height=30px></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---->
        <div class="col">
          <div class="card shadow-sm">
            <a href="inicio.php"><img src="img\productos\consola.png" class="bd-placeholder-img card-img-top"
                alt=" "></img></a>
                <div class="card-body">
              <h1> PS5 </h1>
              <p class="card-text">La Play Station 5 es perfecta para aquellos que quieren divertirse en familia o a solas. Este dispositivo promete la mejor calidad y una experiencia única.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">$1.499.999</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><img src="img\carrito.png" alt="50" height=30px></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---->
        <div class="col">
          <div class="card shadow-sm">
            <a href="inicio.php"><img src="img\productos\parlante.png" class="bd-placeholder-img card-img-top"
                alt=" "></img></a>
                <div class="card-body">
              <h1> SRS - B30</h1>
              <p class="card-text">El parlante mas potente del mercado, otorga la mejor calidad de sonido. Fácil de trasportar y con luces para dar ambiente.	</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">$979.999</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><img src="img\carrito.png" alt="50" height=30px></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---->
        <div class="col">
          <div class="card shadow-sm">
            <a href="inicio.php"><img src="img\productos\juego_hogwarts.png" class="bd-placeholder-img card-img-top"
                alt=" "></img></a>
                <div class="card-body">
              <h1> Howarts Legacy</h1>
              <p class="card-text">Sumergete en el mundo de Harry potter y conviertete en el protagonista de tu propia historia dentro de este magico mundo.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">$39.999</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><img src="img\carrito.png" alt="50" height=30px></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---->
        <div class="col">
          <div class="card shadow-sm">
            <a href="inicio.php"><img src="img\productos\camara_productos.png" class="bd-placeholder-img card-img-top"
                alt=" "></img></a>
                <div class="card-body">
              <h1> ZV - E10</h1>
              <p class="card-text">Captura los mejores momentos con la mejor calidad disponible. Esta cámara ofrece lo mejor en calidad al alcance de todos.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">$349.999</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><img src="img\carrito.png" alt="50" height=30px></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
<!-- FOOTER -->
<footer>
  <div class="container">
    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Tienda</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Carrito</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQS</a></li>
      </ul>
          <!-- DEFINICION ARRAY ASOCIATIVO -->
      <?php
      $form_data = [
        "nombre" => [
          "type" => "text",
          "class" => "form-control",
          "id" => "nombre",
          "name" => "nombre",
          "placeholder" => "Nombre",
          "value" => $_SESSION["nombre_usuario"],
          "required" => true
        ],
        "mail" => [
          "type" => "email",
          "class" => "form-control",
          "id" => "mail",
          "name" => "mail",
          "placeholder" => "Mail",
          "required" => true
        ],
        "titulo_mensaje" => [
          "type" => "text",
          "class" => "form-control",
          "id" => "titulo_mensaje",
          "name" => "titulo_mensaje",
          "placeholder" => "Título del mensaje",
          "required" => true
        ],
        "mensaje" => [
          "type" => "textarea",
          "class" => "form-control",
          "id" => "mensaje",
          "name" => "mensaje",
          "placeholder" => "Cuerpo del mensaje",
          "rows" => 4,
          "required" => true
        ]
      ];
      ?>
        <!-- FORM CON ARRAY IMPLEMENTADO -->
      <form action="cargar_mensaje.php" method="POST" class="footer-form">
        <div class="form-row">
          <input 
            type="<?php echo $form_data['nombre']['type']; ?>" 
            class="<?php echo $form_data['nombre']['class']; ?>" 
            id="<?php echo $form_data['nombre']['id']; ?>" 
            name="<?php echo $form_data['nombre']['name']; ?>" 
            value="<?php echo $form_data['nombre']['value']; ?>" 
            placeholder="<?php echo $form_data['nombre']['placeholder']; ?>" 
            <?php echo $form_data['nombre']['required'] ? 'required' : ''; ?>>

          <input 
            type="<?php echo $form_data['mail']['type']; ?>" 
            class="<?php echo $form_data['mail']['class']; ?>" 
            id="<?php echo $form_data['mail']['id']; ?>" 
            name="<?php echo $form_data['mail']['name']; ?>" 
            placeholder="<?php echo $form_data['mail']['placeholder']; ?>" 
            <?php echo $form_data['mail']['required'] ? 'required' : ''; ?>>
        </div>
        <div class="form-row">
          <input 
            type="<?php echo $form_data['titulo_mensaje']['type']; ?>" 
            class="<?php echo $form_data['titulo_mensaje']['class']; ?>" 
            id="<?php echo $form_data['titulo_mensaje']['id']; ?>" 
            name="<?php echo $form_data['titulo_mensaje']['name']; ?>" 
            placeholder="<?php echo $form_data['titulo_mensaje']['placeholder']; ?>" 
            <?php echo $form_data['titulo_mensaje']['required'] ? 'required' : ''; ?>>
        </div>
        <textarea 
          class="<?php echo $form_data['mensaje']['class']; ?>" 
          id="<?php echo $form_data['mensaje']['id']; ?>" 
          name="<?php echo $form_data['mensaje']['name']; ?>" 
          placeholder="<?php echo $form_data['mensaje']['placeholder']; ?>" 
          rows="<?php echo $form_data['mensaje']['rows']; ?>" 
          <?php echo $form_data['mensaje']['required'] ? 'required' : ''; ?>></textarea>
        <button type="submit" name="btnEnviarMensaje" class="btn btn-primary">Enviar</button>
      </form>
      <p id="parrafo" class="text-center">© 2024 - Goslino, Franco Nicolas.</p>
    </footer>
  </div>
</footer>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- CIERRE DE FOOTER -->

</body>
<!-- SCRIPT BOOSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>