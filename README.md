# Sony Store E-commerce

![Sony Store Banner](https://logodownload.org/wp-content/uploads/2014/02/sony-logo-3.png)

## 🚀 Descripción del Proyecto

Sony Store es una plataforma de comercio electrónico moderna y segura para la venta de productos electrónicos de Sony. Desarrollada con tecnologías web actuales, ofrece una experiencia de compra fluida tanto para clientes como para administradores.

## ✨ Características Principales

### 👥 Módulo de Usuarios
- Registro e inicio de sesión seguro
- Perfiles personalizables
- Historial de compras
- Sistema de roles (admin/usuario)

### 🛍️ Catálogo de Productos
- Visualización de productos con imágenes en alta resolución
- Búsqueda y filtrado avanzado
- Categorías y etiquetas
- Valoraciones y reseñas

### 🛒 Carrito de Compras
- Gestión de productos en tiempo real
- Cálculo automático de totales
- Proceso de pago seguro
- Historial de pedidos

### 🛠️ Panel de Administración
- Gestión de usuarios
- Administración de productos
- Sistema de mensajería
- Reportes y estadísticas

## 🛠️ Tecnologías Utilizadas

### Frontend
- HTML5, CSS3, JavaScript (ES6+)
- [Bootstrap 5](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [Animate.css](https://animate.style/) para animaciones
- [Font Awesome](https://fontawesome.com/) para iconos

### Backend
- PHP 7.4+
- MySQL
- Arquitectura MVC
- PDO para consultas seguras

### Seguridad
- Protección contra inyección SQL
- Validación de datos del lado del servidor
- Protección XSS
- Manejo de sesiones seguro

## 🚀 Instalación

1. **Requisitos**
   - Servidor web (Apache/Nginx)
   - PHP 7.4 o superior
   - MySQL 5.7 o superior
   - Composer (para dependencias)

2. **Configuración Inicial**
   ```bash
   # Clonar el repositorio
   git clone [URL_DEL_REPOSITORIO]
   cd Redise-o-SONY

   # Configurar base de datos
   - Importar el archivo SQL ubicado en /database/sony_store.sql
   - Configurar las credenciales en /config/database.php

   # Configurar servidor web
   - Establecer el directorio público como raíz
   - Asegurar que el archivo .htaccess esté habilitado
   ```

3. **Estructura de Directorios**
   ```
   /assets/         # Archivos estáticos (CSS, JS, imágenes)
   /config/         # Archivos de configuración
   /controllers/    # Controladores de la aplicación
   /models/        # Modelos de datos
   /views/         # Vistas de la aplicación
   /database/      # Scripts y migraciones de la base de datos
   /vendor/        # Dependencias de Composer
   ```

## 📱 Diseño Responsivo

La aplicación está diseñada para funcionar perfectamente en:
- Escritorio
- Tablets
- Dispositivos móviles

## 🔒 Seguridad

- Todas las contraseñas se almacenan con hash seguro (password_hash)
- Protección contra CSRF
- Validación de datos en frontend y backend
- Headers de seguridad HTTP
- Sanitización de entradas de usuario

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor, lee las [guías de contribución](CONTRIBUTING.md) para más información.

## 📧 Contacto

¿Preguntas o sugerencias? ¡No dudes en contactarnos!

---

<div align="center">
  Hecho con ❤️ por [Franco Goslino] - 2025
</div>
