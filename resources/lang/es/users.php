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

    'user' => [
        'title' => 'Usuarios',
        'title_change_password' => 'Cambiar contraseña',
        'list' => 'Lista de usuarios',
        'labels' => [
            'create' => 'Crear usuario',
            'new' => 'Nuevo usuario',
            'edit' => 'Editar usuario',
            'update' => 'Actualizar',
            'details' => 'Detalles',
            'delete' => 'Eliminar el usuario',
            'delete_bulk' => 'Eliminar usuarios seleccionados',
            'status' => 'Habilitar/Inhabilitar usuario',
            'status_bulk' => 'Habilitar/Inhabilitar usuarios seleccionados',
            'role' => 'Rol',
            'actions' => 'Acciones',

            'first_name' => 'Nombre(s) del usuario',
            'last_name' => 'Apellido(s) del usuario',
            'email' => 'Correo Electrónico',
            'photo' => 'Foto',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'password_confirm' => 'Confirmar contraseña',

            'info' => 'Información del usuario',
            'profile_title' => 'Perfil de usuario',
            'full_name' => 'Nombre',
            'created_at' => 'Creado',

            'select_role' => 'Seleccione el rol para el usuario',
            'change_password' => 'Modificar contraseña la primera vez',

        ],

        'placeholders' => [
            'username' => 'Nombre de usuario',
            'first_name' => 'José Luis',
            'last_name' => 'Pérez Rodríguez',
            'email' => 'jose.luis@email.com',
            'password' => 'Ingrese la contraseña',
            'password_confirm' => 'Confirme la contraseña',
            'document_type' => 'Seleccione tipo de identificación',
            'document' => 'Identificación del usuario',
        ],

        'headers' => [
            'username' => 'Usuario',
        ],

        'messages' => [
            'confirm' => [
                'delete' => '¿Está seguro que desea eliminar el usuario?',
                'update' => '¿Está seguro que desea actualizar el usuario?',
                'delete_bulk' => '¿Está seguro que desea eliminar los usuarios seleccionados?',
                'status_bulk' => '¿Está seguro que desea cambiar el estado a los usuarios seleccionados?',
                'status_on' => '¿Está seguro que desea habilitar al usuario seleccionado?\n\nEl usuario podrá acceder al sistema.',
                'status_off' => '¿Está seguro que desea inhabilitar al usuario seleccionado?\n\nEl usuario no podrá acceder al sistema.',
            ],
            'success' => [
                'created' => 'Usuario creado satisfactoriamente',
                'updated' => 'Usuario actualizado satisfactoriamente',
                'updated_bulk' => 'Usuarios actualizados satisfactoriamente',
                'deleted' => 'Usuario eliminado satisfactoriamente',
                'deleted_bulk' => 'Usuarios eliminados satisfactoriamente',
                'password_changed' => 'Contraseña actualizada satisfactoriamente',
            ],
            'validation' => [
                'document_exists' => 'El documento ya existe',
                'username_exists' => 'El nombre de usuario ya existe',
                'email_exists' => 'El correo electrónico ya existe',
                'extension' => 'El archivo debe tener la extensión jpg ó jpeg ó png',
                'password_not_equal' => 'Por favor escriba la misma contraseña',
            ],
            'errors' => [
                'create' => 'Ha ocurrido un error al intentar crear el usuario',
                'update' => 'Ha ocurrido un error al intener actualizar el usuario',
                'delete' => 'Ha ocurrido un error al intentar eliminar el usuario',
                'password' => 'Ha ocurrido un error al intentar cambiar la contraseña',
            ],
            'exceptions' => [
                'not_found' => 'El usuario no existe o no está disponible',
            ],
        ],
    ],
    'email' => [
        'head' => 'Saludos este es un email para recuperar la contraseña',
        'body' => 'Hola estimad@',
        'notify' => 'Revisala en el siguiente link:',
        'footer' => 'Saludos (MIS EVENTOS CERCANOS)'
    ]
];
