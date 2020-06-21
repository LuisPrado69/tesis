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
        'enabled' => 'Activar/ Desactivar'
    ],
    'placeholders' => [
        'name' => 'Nombre'
    ],
    'messages' => [
        'success' => [
            'created' => 'Evento creada exitosamente',
            'updated' => 'Evento editada exitosamente'
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
    ]
];