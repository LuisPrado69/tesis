# Modal

Los modals se encuentran en el archivo index.blade.php de la carpeta layout en views de los resources, existen 4 tipos de tamaños de modals configurados actualmente.

- modal
- modal-xl
- modal-lg
- modal-sm

Los cuales son llamados mediante ajax o referenciados en una respuesta con modal, asignándoles el contenido que llevaran en la petición.

# Permisos

Los permisos se gestionan desde la base de datos con una serie de tablas a continuación

- Permisos
En la que se crean los nombres de agrupaciones de permisos a emplear teniendo como permisos básicos:


 - Roles (slug = roles)
 - Usuarios (slug = users)
 - Template (una agrupación de permisos de prueba)
 

 En los que cada uno de estos tiene su configuración(un objeto JSON), que integran los distintos niveles de permisos de este conjunto, que a su vez puede contener otros permisos concedidos automáticamente al conceder el padre definidos como inner del permiso padre, con sus atributos de acceso(ya sea permitido o denegado), y otro atributo llamado Label que representa el nombre de la acción de este permiso.

 En este caso (porque no existen mas), estos conjuntos de permisos base son los que definirán las acciones que podrán ejecutar luego los roles hijo,
 definidos por un parent_id (en los base, el parent es null).

 Un ejemplo de los sub-permisos que se conceden automáticamente es al conceder el permiso ```EDIT{"edit": {"inner": {"update": {"allowed": false}, "checkname":{"allowed":true}}``` se concede su sub-permiso UPDATE y CHECKNAME, aquí los usuales permisos de un conjunto:

 
 - Index
 - Edit
 - Create
 - Disable
 

 El JSON quedaría con una estructura parecida a esta ```{"update":{"allowed" : true}}```.

 El slug se usa para acceder o no a las distintas secciones de la pagina, ya que este es el 'nombre' de la ruta que se usa para acceder a las secciones
por lo que se hace una comprobación si tienes este permiso, para dejarte pasar

 En cada sección de la pagina se carga o no dependiendo si el usuario tiene el permiso necesario usando el parámetro de laravel ```@permission()```
pasando como variable una ruta, ejemplo data.index.users (correspondiente al conjunto Users, el permiso Index y sub-permiso Data), al redirigir al controlador este puede hacer una 
confirmación del permiso mediante la llamada al JSON :

 - Ruta : ```Route::get('/users/data', 'Admin\UserController@data')->name('data.index.users');``` 
 este va al controlador UserController a su método ```data()```.

 - Controlador : UserController
Este verifica mediante el método ```can()``` si el rol que tiene designado, tiene acceso a esta ruta.


- Roles
Después de haberse designados los conjuntos de permisos para la aplicación, se procede a asignar estos a los roles que se usaran para cada usuario, los roles por defecto son:


 - Developer(Un único usuario, con todos los permisos habilitados)
 - Administrador

   
  Cuando se crea un nuevo rol, se hace un match de este rol con todos los conjuntos de permisos existentes donde se designa cuales tiene habilitados en cada conjunto, por ejemplo para el rol "Nuevo" se hace un match de los permisos existentes (Roles,Usarios,Template).

 
  - Donde : ```roles.nuevo```  son los permisos habilitados que tiene el rol "Nuevo" del conjunto "roles".

  
------------


- Usuarios
Luego de tener los permisos establecidos, y los roles a usar con los permisos definidos, se le asigna un rol a un usuario para ingresar al sistema.


# Menus

La plantilla gestiona su barra de menú, usando datos que son traídos de la base de datos, con la estructura a consolidar, teniendo como principal atributos el 'Label' que es el nombre del menú, el parent_id que especifica si este pertenece a otro (si es un sub-menú), y el slug que en este caso es la ruta de acceso, por ejemplo (```index.users```, que a su vez es un permiso que contiene el usuario), pudiendo así ver el menú en la barra.


 - Un menú puede existir en la base de datos, pero estar des-habilitado, y así no ser tomado en cuenta a la hora de mostrarse en la barra.

 
# Sistema

Se ha definido una estructura para realizar los controladores a la hora de programar, y en esta es necesario ingresar el código pertinente de los propios métodos dentro de bloques ```Try & Catch``` para el correcto manejo de las posibles errores que se podrían realizar.


```
try {
		/*  El codigo va aqui*/
		$response = [];
        } catch (\Throwable $e) {
            $reponse = defaultCatchHandler($e);
        }
		return reponse()->json($response);
```

------------


Ademas de las carpetas predeterminadas de laravel, skeleton maneja unas carpetas propias que son ```Processes, Repositories & Helpers``` :

- Las primeras dos los integramos a los controladores mediante el uso del constructor propio del controlador (Laravel los instancia automaticamente con Inyeccion de Dependencia) . Estos son los intermediarios para :
 
 - ```Processes``` : se usa para incluir toda la lógica de negocio.
 
 - ```Repository``` :  se usa cuando necesitemos leer, crear y actualizar información a la base de datos.
 
y todas las operaciones asociadas a esta como traer un grupo determinado etc.

 *teniendo asi que para cada conjuntos de datos, por ejemplo una tabla especifica estas tengan su propio ```Process, Repository & Controller```*

- La Carpeta ```Helpers``` esta para almacenar en esta los distintos métodos que fuéramos a requerir en toda la aplicación y así centralizarlos en un lugar concreto, skeleton ya cuenta con dos archivos dentro de esta carpeta que son :
 
- ```Global``` : son un grupo de funciones que necesitaremos en toda la aplicación como por ejemplo el ```defaultCatchHandler``` que se usa específicamente para manejar los errores provenientes de los ```Catch```
 
*Los ```Helpers``` son cargados automáticamente al sistema mediante la función del composer 'Auto-Load' que a su vez también cargas las demás clases necesarias para la ejecución de la aplicación*



# DataTables

Nosotros solemos usar una estructura base para las datatables ya definida, que esta conformada por estos elementos:

## Backend

 - Columna id :
  Esta lleva el orden en la que se mostraran los datos y es asignada mediante el método ```setRowId()```

 - Columna update_at :
 Esta se usa para mostrar el intervalo de tiempo en el que un objeto ha sido actualizado.

- Columna enabled :
 En esta columna se integra una vista personalizada, primero dependiendo de si el usuario tiene permisos para activar o desactivar el objeto, según esta condicional se devuelve una vista en formato html, que contiene un checkox de tipo switch, para crear esta columna se usa un ```editColumn()``` para editar la columna ```enabled``` que se forma al traer la información de la base de datos, y así agregarle la funcionalidad del switch.

- Columna bulk_action :
 Esta es una implementacion mas extendida de la anterior, donde hay la posibilidad de poder activar o desactivar en cantidades con la opción de seleccionar todos, con otro tipo de checkox.

- Columna actions :
 Esta primero revisa que permisos tienes disponibles para actuar sobre los objetos de la lista, y en base a esto, genera una serie de botones con las acciones permitidas por ejemplo actualizar y ver los detalles.

 *Luego de haber creado todas las columnas necesarias para las tablas, hay que ingresar las que usen Html para crearse en un ```rawColums()``` esta es una medida de seguridad
 que tiene laravel para protegernos de ataques XSS, y finalmente ejecutar la función ```make()``` para traer los datos organizados*

 *Para la creación de la colección resultante se usa el ORM Eloquent de Laravel*


------------
## Frontend

En la vista, se crea una estructura básica de una tabla con su pertinente id, se definen las distintas cabeceras que tendrá la tabla, mediante un método ```Build_Tables()``` personalizado en este proyecto Skeleton, que recibe tres variables:

1. Es el selector que tomara el id del elemento html en el que queremos armar la tabla.
2. Es la configuración de la tabla, es donde se recibe la respuesta con la colección, y se procede a asignarles las variables necesarias para la correcta presentación de la tabla, como pueden ser el ```width```,```sortable``` o ```searchable``` .
3. Es la función encargada de darle interactividad al switch en las filas de la columna.

# Notificaciones

 Las notificaciones son almacenadas también en la base de datos, con un asunto y un cuerpo (que vendría siendo la información a transmitir).

 - Estas son asignadas a un usuario, manteniendo el id del que lo ha enviado y con un atributo extra 'read' que especifica si la notificación 
	ya ha sido leída.

# Datos Iniciales

- Provincias & Cantones
 La platilla viene integrada con los migrations y sedeers, para la creación y población de los datos de todas las provincias y cantones de Ecuador.

# Xdebug
Instalar Xdebug
- Actualizar Vagrant y Homestead: para actualizar vagrant solo se debe descargar la última versión desde la página oficial y reinstalar. En el caso de Homestead, una vez instalado vagrant, ejecutar el comando: ```vagrant box update```
- Ingresar a la máquina virtual y verificar la versión de php, esto para descargar la versión exacta del paquete xdebug, compatible con la instalación actual de php. Se puede ingresar en [Xdebug.org](https://xdebug.org/wizard.php) el resultado de ejecutar `php -i` para obtener los datos de la versión y URL de descarga del paquete xdebug.
- Ingresar al directorio home de la máquina virtual, descargar, descomprimir e instalar el paquete xdebug con los siguientes comandos:
```
    cd ~
    wget http://xdebug.org/files/xdebug-2.6.0.tgz
    tar -xvzf xdebug-2.6.0.tgz
    cd xdebug-2.6.0
    phpize
    ./configure
    make
    cp modules/xdebug.so /usr/lib/php/20170718
```
- Editar el archivo de configuración `php.ini` ubicado en las siguientes rutas `/etc/php/7.2/cli/php.ini` y `php.ini /etc/php/7.2/fpm/php.ini`; aumentar las siguientes líneas:
 ```
     [Xdebug]
     zend_extension = /usr/lib/php/20170718/xdebug.so
     xdebug.remote_enable = 1
     xdebug.remote_port = 9000
     xdebug.remote_host = 10.0.2.2
     xdebug.profiler_enable = 1
     xdebug.profiler_output_dir = /home/vagrant/tmp
```
   En este paso se debe tomar en cuenta que la configuración `zend_extension = /usr/lib/php/20170718/xdebug.so` se la puede omitir y configurar directamente desde las preferencias de PhpStorm para que funcione en modo bajo demanda, esto mejora en algo el rendimiento. 
- Reiniciar el servicio `sudo service php7.2-fpm restart`

Configurar Navegador (Google Chrome)
- Buscar e instalar la extensión `Xdebug helper`.
- Una vez instalada la extensión, junto a la barra de direcciones aparece un ícono para poder iniciar el debugging en la página actual.
- Reiniciar el navegador.
-----
Configurar PhpStorm
- En Archivo - Preferencias - Lenguajes y Frameworks - PHP, ingresar en CLI Interpreter, si todo fue configurado correctamente, bajo la sección General junto a la versión de php debe indicar la versión del debugger instalado, en este caso Xdebug 2.6.0 
- Si no se habilitó la instrucción `zend_extension = /usr/lib/php/20170718/xdebug.so` en el archivo php.ini, en la pestaña de CLI Interpreter indicará `not installed`, y se debe configurar la ruta `/usr/lib/php/20170718/xdebug.so` en el campo `Debugger extension`
- En la pestaña servers, en el servidor actual debe estar seleccionado Xdebug y en el mapeo debe indicarse la ruta absoluta del servidor por ejemplo: `/home/vagrant/code/skeleton`.
- Para que PhpStorm empiece a escuchar peticiones de debug desde el navegador, se debe habilitar la opcion *Start Listening for PHP Debug Connections* del menu Run o presionando el icono correspondiente de la barra de navegación, siempre y cuando en el navegador también esté habilitada la opción para enviar peticiones de debug.

-----

# Queries listener
Si desea recibir cada consulta SQL ejecutada por su aplicación, puede usar el método ::listen() en la función boot() del ServiceProvider.
    
    DB::listen(function ($query) {
        Log::info([
            $query->sql,
            $query->bindings,
            $query->time
        ]);
    });

Este método es útil para registrar consultas o depurar. Puede registrar las consultas de la base de datos en un ServiceProvider, en Skeleton este se encuentra en: App\Providers\AppServiceProvider
    
    <?php
    
    namespace App\Providers;
    
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\ServiceProvider;
    
    class AppServiceProvider extends ServiceProvider
    {    
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            DB::listen(function ($query) {
                Log::info([
                    $query->sql,
                    $query->bindings,
                    $query->time
                ]);
            });
        }
    } 
----