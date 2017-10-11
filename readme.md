## Documentacion Aplicación AHPCA
  
Todos los archivos que se necesiten están en el repositorio configurados. Los puedes usar de ejemplo.
  
Necesitamos tener instalado:
* Docker
* Php
* Composer
  
Una vez todo instalado, creamos un proyecto:

` composer create-project laravel/laravel “nombre del proyecto” `
  
Nos vamos a [Laradock](http://laradock.io) y seguimos los pasos de instalación, configurando según nuestras necesidades.
  
Una vez lo tengamos listo ejecutamos:
  
` docker-compose up -d nginx postgres ` 
  
Ahora si accedemos a localhost tendremos que ver la página de inicio de Laravel
  
  ![imagen](Documentacion/laravel.png)

Configuramos el archivo .env correctamente y no tendremos que cambiar nada de Laradock. Lo siguiente seria configurar el archivo `config/database.php` en Laravel, para tener acceso a la base de datos.
  
Y para tener acceso al contenido del contenedor desde nuestro equipo tenemos que modificar en el archivo `.env` de laradock:
* Application Path (para la aplicacion laravel)
* Data Path (para los datos de la base de datos)
  
Añadiendo la ruta de nuestro equipo. Ej: `APPLICATION=../` o `DATA_SAVE_PATH=../data`


### Documentacion de interés
* [Docker](https://docs.docker.com)
* [Laravel](https://laravel.com/docs/5.4/installation)
* [Laradock](http://laradock.io)

### Comandos utiles
* Docker
  
Iniciar contenedores:
  
  `docker-compose up -d nginx postgres`

Para contenedores:
  
  `docker-compose stop`
  
Ver contenedores activos:
  
  `docker-compose ps`
