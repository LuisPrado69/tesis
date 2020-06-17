# Buenas Prácticas

###Mensajes: 
- Los mensajes siempre deben ser en formato de usted.
- Los mensajes deben tener un color correspondiente a su tipo, por ejemplo el de error debe ser rojo, advertencia deben ser amarillos, etc.
- Revisar cuidadosamente los campos o labels en busca de errores ortográficos.
- Los mensajes de campos deben estar estandarizados por ejemplo ```El formato de correo debe ser: dirección@dominio.com.```
- Los mensajes de error o éxito no pueden ser los mismos siempre, deben referirse al contexto en el que se trabaja.

###Formularios:
- Los botones deben tener un texto correspondiente a la acción que ejecutan por ejemplo ```Guardar``` en vez de ```Aceptar```, y de ser iconos deben tener una leyenda que indique su acción.
- Los placeholders deben contener información que oriente por ejemplo, ```Email : juanperez@dominio.com.```
- Los campos de números como de RUC, Teléfonos y Cédula se deben limitar dependiendo de lo requerido, ```Cédula: { maxlenght: 10 }.```
- Se debe evaluar las situaciones en las que se deben usar ```ComboBox``` o en su defecto ```Auto-Completar```, dependiendo de si el campo crecerá dinámicamente, o es una cantidad fija.
- Los botones de enviar, submit, etc deben tener un control para que no se le pueda dar click varias veces.
- La longitud de los campos de texto se le debe establecer los límites para que sea igual a la base de datos, y así evitar cortar la información.
- Si se sube un archivo, controlar las extensiones y tamaños permitidos.
- Cuando se controla las extensiones y tamaños permitidos, notificarle al usuario cuales son los requisitos necesarios.
- No nombrar los formularios de actualización como ```Editar Usuario```, siempre llamarlos ```Actualizar```.

###Presentación
- Las pruebas que se vayan a usar para una presentación deben usar datos de contexto real, por ejemplo no usar un nombre como "jasndkjas kjasnkda" sino "Juan Pérez"
- Hay que recordar de cambiar o colocar los respectivos favicon ya que se suelen olvidar.
- Siempre asignarle a las tablas al menos un elemento de búsqueda, ya sea nombre, fecha, categoría, etc.
- Los ```Dialogs``` o ```Modal``` deben tener una ```X``` en la esquina superior derecha para cerrarlos.
- En las listas si no hay ningún elemento, se debería colocar "No hay elementos".
- Algunas veces cuando se transforman las minúsculas a mayúsculas, las letras con tildes o las ñ suelen quedarse en minúsculas, se debería hacer una función que cambie independientemente si es carácter especial o no a mayusculas con su correspondiente.
- Cuando los modales son grandes y se usan opciones que están muy abajo, redireccionar de nuevo al centro.
- Si un link no lleva a ninguna parte, redireccionar a una página estándar de construcción para informar de que aún no esta listo.

###Otros
- Cuando hay que guardar información en multiples tablas o gran cantidad en una, se recomienda usar ```DB::beginTransaction(), DB::commit(), DB::rollback()```, Con su respectivo ```Try - Catch.```
- En los eventos javascript dentro de una tabla, a veces no se aplican mas allá de la primera página, para evitar esto se debe usar la función ```each()``` para aplicar a cada uno.
