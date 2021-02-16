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
    'title' => 'Eventos',
    'labels' => [
        'create' => 'Crear evento',
        'new' => 'Nueva evento',
        'update' => 'Actualizar evento',
        'edit' => 'Editar evento',
        'name' => 'Nombre',
        'description' => 'Descripción',
        'date' => 'Fecha',
        'date_start' => 'Fecha inicio',
        'date_end' => 'Fecha final',
        'url' => 'Dirección url',
        'category_id' => 'Categoria',
        'location_id' => 'Localidad (lugar)',
        'enabled' => 'Activar/ Desactivar'
    ],
    'placeholders' => [
        'name' => 'Nombre',
        'description' => 'Descripción',
        'date' => 'Fecha',
        'date_start' => 'Fecha inicio',
        'date_end' => 'Fecha final',
        'url' => 'Dirección url',
        'category_id' => 'Categoria',
        'location_id' => 'Localidad (lugar)'
    ],
    'messages' => [
        'success' => [
            'created' => 'Evento creado exitosamente',
            'updated' => 'Evento editado exitosamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el evento',
            'update' => 'Ha ocurrido un error al intentar editar el evento'
        ],
        'exceptions' => [
            'not_found' => 'El evento no existe o no está disponible'
        ],
        'confirm' => [
            'status_on' => '¿Está seguro que desea habilitar el evento seleccionado?',
            'status_off' => '¿Está seguro que desea deshabilitar el evento seleccionado?'
        ],
        'validation' => [
            'name' => 'Nombre de evento usado anteriormente'
        ]
    ],
    'email' => [
        'head' => 'Saludos, este es un email para notificarte de un nuevo evento cercano',
        'head_update' => 'Saludos, este es un email para notificarte de la edición de un evento cercano',
        'body' => 'Hola estimad@',
        'detail' => 'Nombre del evento',
        'date' => 'Fecha del evento',
        'notify' => 'Revisala en nuestra App',
        'footer' => 'Saludos (MIS EVENTOS CERCANOS)'
    ]
];















