<!DOCTYPE html>
<?php 
session_start();
require_once "conexion.php";

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


    <style>
        body{
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
  <body id=body-admin>
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
            <a class="nav-link" href="admin-modificar.php">Modificar</a>
            <h3>Gestion Productos</h3>
            <a class="nav-link" href="admin-crear.php">Crear</a>
            <a class="nav-link" href="admin-modificar.php">Modificar</a>
        </div>
    <section class="container" >
        <!-- CONTENIDO PRINCIPAL -->
        <div class="container">
            <div class="col-sm-12">
            <br><h1>Lista de usuarios</h1><br>
                
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr >
                    <th scope="col">id_usuario</th>
                    <th scope="col">nombre</th>
                    <th scope="col">apellido</th>
                    <th scope="col">mail</th>
                    <th scope="col">usuario</th>
                    <th scope="col">clave</th>
                    <th scope="col">permiso</th>

                    </tr>
                    <tr class="table-group-divider"></tr>
                </thead>
                <tbody>
                <?php
                    require_once "conexion.php";
                    
                    $result = mysqli_query($conexion, "SELECT * FROM usuarios");
                    
                    while ($fila = mysqli_fetch_assoc($result)):
                    $datos = $fila['id_usuario']."||".
                    $fila['nombre']."||".
                    $fila['apellido']."||".
                    $fila['mail']."||".
                    $fila['usuario']."||".
                    $fila['clave']."||".
                    $fila['permiso'];
                ?>
                <div>
                    <tr>
                        <td><?php echo $fila["id_usuario"]; ?></td>
                        <td><?php echo $fila["nombre"]; ?></td>
                        <td><?php echo $fila["apellido"]; ?></td>
                        <td><?php echo $fila["mail"]; ?></td>
                        <td><?php echo $fila["usuario"]; ?></td>
                        <td><?php echo $fila["clave"]; ?></td>
                        <td><?php echo $fila["permiso"]; ?></td>
                        <td>
                            <button id=botones-admin-editar type="button" name="accion" value="Modificar" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></a>
                      
                            </button>
                                <button id=botones-admin-eliminar type="button" name="accion" value="Borrar" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg></a>
                            </button>
                            <!-- Modal desplegado por button-->
                            
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos de: USUARIO</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required value= "<?php echo $nombre["nombre"]; ?>">
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
                                            <select class="form-control" id="permiso" name="permiso" placeholder="permiso" required-value="">
                                                <option value="user">Usuario</option>
                                                <option value="admin">Administrador</option>
                                            </select>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                        </div>
                                        <form action="admin-registrar.php" method="POST">
          
                                    </div>
                                </div>
                            </div>
                        
                            
                        </td>
                    </tr>
                </div>
                    <?php endwhile; ?>
            </table>
            

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

            <script>
            $(docuemnt).ready(function(){
                $("#tabla").DataTable;
            })
            </script>
            
        </div>
        </section>
</body>
</html>
