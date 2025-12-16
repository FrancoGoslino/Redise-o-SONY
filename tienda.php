<?php
  session_start();
?>

<!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WIKI HUNTERxHUNTER</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="css/estilos.css" />
    <link rel="stylesheet" href="css/modal.css" />

  </head>
  
  <body>


    <!-- NAV BAR -->
    <!-- PERFIL -->
    <header>
      <section>
        <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container-fluid" id="containerPerfil">
            <div class="interior">
                <a class="navbar-brand" class="btn" href="#open-modal"><img src="img\perfil.png" alt="50" height=30px></a>
              <div id="open-modal" class="modal-window">
                <div class="boxPerfil">
                    <a href="#" title="Close" class="modal-close">Cerrar</a>
                  <h1>Franco Goslino</h1>
                    <p class="claseTarjeta">Permisos: Administrador</p>
                  <div>
                    <img class="fotoPerfil" height="150px" src="https://i.pinimg.com/originals/42/11/4c/42114cb0d582fb35b2f005bb1880e11b.jpg" alt="" />
                    <h3>Datos del usuario</h3>
                      <p class="datosTarjeta">Nick Name</p>
                    <h6>FrancoHunter_123</h6>
                      <p class="datosTarjeta">Habilidad Nen</p>
                    <h6>Goma bungee, Velocidad del rayo, electrico</h6>
                      <p class="datosTarjeta">Personaje favorito</p>
                    <h6>Killua Zoldyck</h6>
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
          <!-- OPCIONES MENU -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
              <a class="nav-link" href="productos.php">productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="capitulos.html"><img src="img\carrito.png" alt="50" height=30px></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="tienda.html">Tienda</a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="faqs.html" aria-disabled="true">FAQS</a>
              </li>
            </ul>
          </div>
        </nav>
      </section>
    </header>

<!-- CARD -->
    
<h1>productos aqui</h1>


<!-- FOOTER -->





<!-- SCRIPT BOOSTRAP -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

</html>