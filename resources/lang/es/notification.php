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

    'title' => 'Notificaciones',

    'labels' => [
        'see_all' => 'Ver Todas',
        'create' => 'Enviar notificación',
        'new' => 'Nuevo mensaje',
        'subject' => 'Asunto',
        'recipients' => 'Destinatarios',
        'send' => 'Enviar',
        'font_small' => 'Pequeña',
        'font_normal' => 'Normal',
        'font_big' => 'Grande',
        'from' => 'De',
        'all' => 'Ver todas',
        'empty' => 'No tiene notificaciones',
    ],


    'messages' => [
        'success' => [
            'created' => 'La notificación ha sido enviada satisfactoriamente',
            'deleted' => 'La notificación ha sido eliminada satisfactoriamente',
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la notificación?',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la notificación',
            'delete' => 'Ha ocurrido un error al intentar eliminar el atajo',
        ],
        'exception' => [
            'not_found' => 'No existe la notifiación solicitada',
        ]
    ]
];
