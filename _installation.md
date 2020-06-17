# BACK OFFICE SKELETON

## Instalación:

* Requiere PHP 7.2.*, MySQL 5.7.*, Apache 2.4.*

* Debe tener instalado como mínimo los módulos: `php-pdo, php-mysqlnd, php-mcrypt, php-mbstring, php-xml, php-gd`

* Se debe haber instalado los aplicativos: Node, NPM, Composer.

### Para una instalación fresca:
    
1. Instalar dependencias.
    * `composer install --prefer-dist`

2. Configurar parámetros.
    * Copiar `.env.example` a `.env` y actualizar los parámetros por defecto con los reales.
    * Crear el esquema de base de datos (por ejemplo `skeleton`).

3. Generar token de seguridad.
    * `php artisan key:generate`

4. Instalar plugins de presentación.
    * `npm install --save`

5. Generar los assets.
    * `npm run dev`

6. Publicar configuraciones de vendors.
    * `php artisan vendor:publish --provider="SlonCorp\Acl\AclServiceProvider"`
    * `php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"`

7. Crear tablas de base de datos e insertar datos base
    * En ambiente de desarrollo se puede usar el comando `php artisan sloncorp:seed`. Este comando borra todas las tablas y vuelve a crear tablas y datos base.
    * En ambiente de producción se debe hacer por separado las migraciones y seeders:
    
        * `php artisan migrate --path database/migrations/acl`
        * `php artisan migrate --path database/migrations/system`
        * `php artisan migrate --path database/migrations/queue`
        * `php artisan migrate --path database/migrations/business`
        * `php artisan db:seed  --class=_System`
        * `php artisan db:seed  --class=_Business`
        * `php artisan db:seed  --class=_Examples`

8. Crear directorio para almacenar imágenes (ejemplo en la máquina virtual Vagrant).
    * `# mkdir -p /var/www/images/PROJECT_NAME`
    * `# chmod -R 777 /var/www/images/PROJECT_NAME`
    * `# ln -s /var/www/images/PROJECT_NAME /home/vagrant/code/PROJECT_NAME/public/assets/images/images`
    
9. Asegurarse que cuando se encienda el servidor los servicios se inicien: `httpd`, `mysql`

10. Colocar los permisos (esto es fundamental en producción). El siguiente ejemplo es para un servidor EC2 de AWS:
    * El $_PATH de instalación para el ejemplo es: /srv/www/sistema.ejemplo.com. Reemplazar $_PATH por el path verdadero en los comandos.
    * Estando conectado con el user `ec2-user` y asumiendo que `apache` es el grupo del servidor Httpd. Correr los comandos:
    * `sudo usermod -a -G apache ec2-user`
    * Solo en este primer comando salir de la consola usando `exit`, volver a conectarse.
    * `groups`. Esto debería indicar que el usuario `ec2-user` ya pertenece al grupo `apache`
    * `sudo chown -R ec2-user:apache $_PATH`
    * `sudo chmod 2775 $_PATH`
    * `find $_PATH -type d -exec sudo chmod 2775 {} \;`
    * `find $_PATH -type f -exec sudo chmod 0664 {} \;`
    * Los siguientes comando son neesarios para que Laravel pueda escribir en Storage y Cache. 
    * `sudo chgrp -R www-data $_PATH/public_html/storage $_PATH/public_html/bootstrap/cache`
    * `sudo chmod -R ug+rwx $_PATH/public_html/storage $_PATH/public_html/bootstrap/cache`