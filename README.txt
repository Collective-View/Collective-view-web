README - Panel Administrativo Collective View
================================================

REQUISITOS PREVIOS
----------------------
- Tener Composer instalado. Si no lo tienes, descárgalo desde la página oficial:
  https://getcomposer.org/
- Tener Node.js y npm instalados. Si no los tienes, descárgalos desde la página oficial:
  https://nodejs.org/
  (npm se instala automáticamente junto con Node.js)
- Tener Git instalado (necesario para el despliegue).
   https://git-scm.com/downloads
- Tener XAMPP instalado.
   https://www.apachefriends.org/es/index.html
- Tener Zotero instalado (para gestionar las referencias).
   https://www.zotero.org/
- Tener VOSviewer (versión de escritorio) instalado (para generar la red de referencias).
   https://www.vosviewer.com/download
- Habilitar las extensiones necesarias de PHP: abrir el archivo "php.ini"
  (ubicado en C:\xampp\php\php.ini) y quitar el "#" al inicio de las líneas
  de las extensiones requeridas por el proyecto (por ejemplo extension=zip,
  extension=fileinfo, extension=gd, extension=curl, extension=mbstring,
  extension=openssl, extension=pdo_mysql), guardar el archivo y reiniciar
  Apache desde XAMPP. Sin este paso, Composer puede fallar o descargar el
  proyecto de forma incompleta.


INSTALACIÓN DEL PROYECTO
------------------------------------
- Ir a la carpeta htdocs de XAMPP y crear el proyecto de Laravel:
   cd C:\xampp\htdocs
   composer create-project laravel/laravel collective-view

- Entrar a la carpeta del proyecto recién creado:
   cd C:\xampp\htdocs\collective-view

- Copiar el proyecto de GitHub y pegarlo dentro del proyecto creado (sobrescribiendo lo necesario).

- Instalar Laravel Sanctum:
   composer require laravel/sanctum

- Generar la key de la aplicación:
   php artisan key:generate

- Instalar las dependencias de npm y correrlo:
   npm install
   npm run build


BASE DE DATOS
---------------------------------
- Abrir XAMPP y encender los módulos Apache y MySQL.
- Ir a http://localhost/phpmyadmin en el navegador.
- Crear una nueva base de datos llamada "collective-view".
- Seleccionar la base de datos recién creada y hacer clic en la pestaña "Importar".
- Elegir el archivo "Collective-view.sql" y hacer clic en "Continuar" para importarlo.
- Verificar que el archivo ".env" del proyecto tenga configurado el mismo nombre de base de datos (DB_DATABASE=collective-view), junto con el usuario y contraseña correspondientes (por defecto en XAMPP: usuario "root", sin contraseña).
- La base de datos de XAMPP debe estar encendida para que el panel administrativo funcione correctamente.
- Asimismo, ante cualquier cambio en el código, debe estar encendida para poder realizar la exportación correctamente.


INICIAR EL PANEL ADMINISTRATIVO
------------------------------------
- Abrir el panel con el comando:
   php artisan serve
- Ingresar en el navegador a:
   http://127.0.0.1:8000/admin


GENERACIÓN DE ARCHIVOS JSON
---------------------------------
   - Primero guardar la referencia desde el panel administrativo mediante un archivo RIS o manual.
   - Luego ejecutar el comando:
     php artisan referencias:generar-json


EXPORTACIÓN DE DATOS
--------------------------
- Si se agrega un nuevo archivo o sección que deba exportarse, modificar el
  archivo "export.php" ubicado en la carpeta "config".
- Para exportar, ejecutar el siguiente comando desde la ruta del proyecto:
  C:\xampp\htdocs\collective-view> php artisan export
- La primera vez que se ejecute "php artisan export" (o la primera vez que
  se corra el script de despliegue "deploy.bat" en una PC nueva), Git pedirá
  autenticación con GitHub para poder hacer el push del sitio exportado.
  En ese momento se debe usar el token de acceso personal proporcionado
  (Personal Access Token) en lugar de la contraseña normal de la cuenta.
  Una vez autenticado, Windows guardará esa credencial y no debería volver
  a pedirla en las siguientes exportaciones.