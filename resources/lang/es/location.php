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
    'title' => 'Localidades',
    'labels' => [
        'create' => 'Crear localidad',
        'new' => 'Nueva localidad',
        'update' => 'Actualizar localidad',
        'edit' => 'Editar localidad',
        'name' => 'Nombre',
        'latitude' => 'Latitud',
        'longitude' => 'Longitud',
        'enabled' => 'Activar/ Desactivar'
    ],
    'placeholders' => [
        'name' => 'Nombre',
        'latitude' => 'Latitud',
        'longitude' => 'Longitud'
    ],
    'messages' => [
        'success' => [
            'created' => 'Categoría creada exitosamente',
            'updated' => 'Categoría editada exitosamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la categoría',
            'update' => 'Ha ocurrido un error al intentar editar la categoría'
        ],
        'exceptions' => [
            'not_found' => 'La categoría no existe o no está disponible'
        ],
        'confirm' => [
            'status_on' => '¿Está seguro que desea habilitar la categoría seleccionado?',
            'status_off' => '¿Está seguro que desea deshabilitar la categoría seleccionado?'
        ],
        'validation' => [
            'name' => 'Nombre de categoría usada anteriormente'
        ]
    ]
];