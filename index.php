<?php
session_start();
require_once "iniciar_sesion.php";
require_once "conexion.php";
require_once "seguridad.php";

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
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
    <style>
    .disponible {
    background-color: #28a745 !important;
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    }
      .agotado {
          background-color: #dc3545 !important;
          color: white;
          font-weight: bold;
          padding: 5px 10px;
          border-radius: 4px;
          font-size: 0.8rem;
          text-transform: uppercase;
          letter-spacing: 0.5px;
      }
          
          .card {
              transition: transform 0.2s;
          }
          .card:hover {
              transform: translateY(-5px);
              box-shadow: 0 4px 8px rgba(0,0,0,0.1);
          }
          .card-img-top {
              transition: opacity 0.3s;
          }
          .card:hover .card-img-top {
              opacity: 0.9;
          }
</style>
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
  <!-- PRODUCTOS DESTACADOS -->
<div class="linea">
  <div>
    <h1>PRODUCTOS DESTACADOS</h1>
  </div>
  <div id="contenedor_destacados" class="container">
    <div id="productos-container" class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-5">
      <!-- Los productos se cargarán aquí dinámicamente -->
      <div class="col-12 text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Cargando productos...</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script para cargar productos dinámicamente -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  
  // Función para formatear el precio
  function formatearPrecio(precio) {
    return '$' + parseFloat(precio).toLocaleString('es-AR');
  }

  // Función para crear una tarjeta de producto
function crearTarjetaProducto(producto) {
    console.log("Datos del producto:", producto);
    
    // Asegurar que la ruta de la imagen sea correcta
    let imagenUrl = producto.imagen || '/proyectoNuevo/img/productos/default.jpg';
    
    // Agregar barra inicial si es necesario
    if (!imagenUrl.startsWith('/') && !imagenUrl.startsWith('http')) {
        imagenUrl = '/' + imagenUrl;
    }
    
    // Agregar timestamp para evitar caché
    imagenUrl += (imagenUrl.includes('?') ? '&' : '?') + 't=' + new Date().getTime();
    
    // Todos los productos están disponibles (se eliminó la lógica de agotado)
    
    // Crear el HTML de la tarjeta
    return `
    <div class="col">
        <div class="card shadow-sm h-100">
            <div class="position-relative">
                <a href="detalle_producto.php?id=${producto.id}">
                    <img src="${imagenUrl}" 
                         class="bd-placeholder-img card-img-top" 
                         alt="${producto.nombre}" 
                         onerror="this.onerror=null; this.src='/proyectoNuevo/img/productos/default.jpg'"
                         style="height: 200px; object-fit: contain; background-color: #f8f9fa; padding: 10px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">${producto.nombre}</h5>
                <p class="card-text flex-grow-1">${producto.descripcion || ''}</p>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-sm btn-outline-secondary flex-grow-1 text-start">
                            ${formatearPrecio(producto.precio || 0)}
                        </button>
                        <button type="button" 
                                class="btn btn-sm btn-outline-primary" 
                                onclick="agregarAlCarrito(${producto.id})">
                            <img src="/proyectoNuevo/img/carrito.png" alt="Agregar al carrito" height="20">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}

  // Función para cargar los productos
function cargarProductos() {
    console.log("Iniciando carga de productos...");
    
    fetch('phpControlador/obtener_productos.php')
        .then(response => {
            console.log("Respuesta del servidor recibida:", response);
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log("Datos recibidos del servidor (raw):", data);
            
            if (!data || !data.success) {
                throw new Error(data.error || 'Error al cargar los productos');
            }
            
            // Debug: Mostrar el primer producto para verificar la estructura
            if (data.data && data.data.length > 0) {
                console.log("Primer producto recibido:", data.data[0]);
                console.log("Tipo de stock:", typeof data.data[0].stock, "Valor:", data.data[0].stock);
            }
            
            const container = document.getElementById('productos-container');
            if (data.data && data.data.length > 0) {
                container.innerHTML = data.data.map(crearTarjetaProducto).join('');
            } else {
                container.innerHTML = '<div class="col-12 text-center"><p>No se encontraron productos.</p></div>';
            }
        })
        .catch(error => {
            console.error('Error al cargar productos:', error);
            const container = document.getElementById('productos-container');
            container.innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-danger">
                        Error al cargar los productos: ${error.message}
                    </div>
                </div>`;
        });
}

  // Función para agregar al carrito (puedes implementar esta función según tus necesidades)
window.agregarAlCarrito = async function(idProducto) {
    try {
        const response = await fetch('phpControlador/manejar_carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_producto: idProducto,
                cantidad: 1
            })
        });
        const data = await response.json();
        if (!response.ok) {
            throw new Error(data.error || 'Error al agregar al carrito');
        }
        // Actualizar el contador del carrito en la interfaz
        const carritoContador = document.getElementById('carrito-contador');
        if (carritoContador) {
            carritoContador.textContent = data.carrito.total_items;
            carritoContador.classList.remove('d-none');
        }
        // Mostrar notificación
        mostrarNotificacion('success', `"${data.producto.nombre}" agregado al carrito`);
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion('danger', error.message || 'Error al agregar al carrito');
    }
};

// Función auxiliar para mostrar notificaciones
function mostrarNotificacion(tipo, mensaje) {
    const toastContainer = document.getElementById('toast-container') || (() => {
        const div = document.createElement('div');
        div.id = 'toast-container';
        div.className = 'position-fixed bottom-0 end-0 p-3';
        div.style.zIndex = '11';
        document.body.appendChild(div);
        return div;
    })();
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${tipo} border-0`;
    toast.role = 'alert';
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${mensaje}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    toastContainer.appendChild(toast);
    
    // Inicializar el toast de Bootstrap
    const bsToast = new bootstrap.Toast(toast, {
        autohide: true,
        delay: 3000
    });
    
    // Eliminar el toast del DOM después de que se oculte
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
    
    bsToast.show();
}

  cargarProductos();
});
</script>
 
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
          "value" => isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : '',
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