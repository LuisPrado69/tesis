<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Message Response Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default messages used by
    | the controller for response.
    |
    */

    'labels' => [
        'system_name' => 'NEWPROJECT',
        'system_slogan' => 'NEWPROJECT SLOGAN',
        'footer' => 'NEWPROJECT FOOTER',
        'loading' => 'Espere un momento por favor...',
        'welcome' => 'Bienvenido/a',
        'title' => 'Navegación',

        'catalogs' => 'Catálogos',
        'login' => 'Acceder',

        'administration' => 'Administración',
        'dashboard' => 'Panel de Control',

        'list' => 'Listar',
        'create' => 'Crear',
        'new' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'details' => 'Detalles',
        'open' => 'Abrir',
        'add' => 'Adicionar',
        'delete' => 'Eliminar',
        'delete_bulk' => 'Eliminar elementos seleccionados',
        'status' => 'Habilitar/Inhabilitar elemento',
        'status_bulk' => 'Habilitar/Inhabilitar elementos seleccionados',
        'select' => 'Seleccionar',
        'management' => 'Gestionar',
        'configure' => 'Configurar',
        'load' => 'Cargar',
        'init' => 'Iniciar',
        'forward' => 'Continuar',
        'backward' => 'Regresar',
        'exit' => 'Salir',
        'close' => 'Cerrar',

        'save' => 'Guardar',
        'save_and_continue' => 'Guardar y continuar',
        'save_and_exit' => 'Guardar y salir',
        'accept' => 'Aceptar',
        'cancel' => 'Cancelar',
        'reject' => 'Rechazar',

        'attention' => '&iexcl;Atención!',
        'error' => 'Error',
        'info' => 'Información',
        'warning' => 'Alerta',

        'all' => 'Todos',
        'select_all' => 'Seleccionar todos',
        'general' => 'General',
        'actions' => 'Acciones',
        'permissions' => 'Permisos',
        'info_general' => 'Información general',
        'info_system' => 'Información del sistema',
        'configuration' => 'Configuración',
        'deny' => 'Permiso denegado',
        'service_error' => 'Error servicio',
        'profile' => 'Mi Perfil',
        'trash' => 'Papelera',
        'change_password' => 'Cambiar contraseña',

        'shortcuts' => 'Accesos directos',
        'notifications' => 'Notificaciones',
        'add_to_shortcuts' => 'Añadir a accesos directos',
        'disabled' => ' (Inhabilitado)',
        'document_type' => 'Tipo de Identificación',
        'document' => 'Identificación',
        'identification_card' => 'Cédula',
        'passport' => 'Pasaporte',
        'ruc' => 'RUC',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el elemento?',
            'delete_bulk' => '¿Está seguro que desea eliminar los elementos seleccionados?',
            'status_bulk' => '¿Está seguro que desea cambiar el estado a los elementos seleccionados?',
        ],
        'success' => [
            'transaction' => 'Acción completada satisfactoriamente',
            'created' => 'Elemento creado satisfactoriamente',
            'updated' => 'Elemento actualizado satisfactoriamente',
            'updated_bulk' => 'Elementos actualizados satisfactoriamente',
            'deleted' => 'Elemento eliminado satisfactoriamente',
            'deleted_bulk' => 'Elementos eliminados satisfactoriamente',
        ],
        'warning' => [
            'unauthorized' => 'No est&aacute autorizado a realizar esta acción'
        ],
        'errors' => [
            'transaction' => 'La acción no se ha completado',
            'create' => 'Ha ocurrido un error al intentar crear el elemento',
            'show' => 'Ha ocurrido un error al intentar obtener los detalles del elemento',
            'update' => 'Ha ocurrido un error al intentar actualizar el elemento',
            'update_bulk' => 'Ha ocurrido un error al intentar actualizar los elementos',
            'delete' => 'Ha ocurrido un error al intentar eliminar el elemento',
            'delete_bulk' => 'Ha ocurrido un error al intentar eliminar los elementos',
            'required' => 'Este campo es obligatorio',
            'required_fields' => 'Debe completar los campos requeridos',
        ],
        'exceptions' => [
            'not_found' => 'El elemento no existe o no está disponible',
            'unexpected' => 'Error inesperado, consulte los logs para más información',
            'session_time_out' => 'Su sesión ha expirado por inactividad',
        ],
    ],

    'headers' => [
        'name' => 'Nombre',
        'last_name' => 'Apellidos',
        'label' => 'Etiqueta',
        'description' => 'Descripción',
        'enabled' => 'Habilitado',
        'actions' => 'Acciones',
        'type' => 'Tipo',
        'date_init' => 'Fecha de inicio',
        'date_end' => 'Fecha de fin',
        'creation_date' => 'Fecha de creación',
        'status' => 'Estado',
        'created_at' => 'Ingresado',
        'updated_at' => 'Actualizado'
    ],

    'error_pages' => [
        'access_denied' => 'Acceso denegado',
        'do_not_have_permissions' => 'Usted no tiene permisos para acceder a este recurso',
        'contact_ti' => 'Contáctese con el departamento de TI para más información',
        'back_control_panel' => 'Ir al Panel de Control',
        'resource_not_available' => 'El recurso no existe o ya no está disponible',
        'resource_not_available_error' => 'Error'
    ]
];
