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


    'title' => 'Atajos',

    'labels' => [
        'delete' => 'Eliminar atajo',
        'delete_bulk' => 'Eliminar atajos seleccionados',
        'see_all' => 'Ver Todos',
        'empty_shortcuts'=> 'No ha creado accesos directos',
        'name' => 'Nombre',
        'save' => 'Guardar Acceso Directo '
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el atajo :name?',
            'delete_bulk' => '¿Está seguro que desea eliminar los atajos seleccionados?'
        ],
        'success' => [
            'created' => 'Atajo creado satisfactoriamente',
            'deleted' => 'Atajo eliminado satisfactoriamente',
            'deleted_bulk' => 'Atajos eliminados satisfactoriamente',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el atajo',
            'delete' => 'Ha ocurrido un error al intentar eliminar el atajo',
            'delete_bulk' => 'Ha ocurrido un error al intentar eliminar los atajos',
            'empty_name' => 'Ingrese un nombre para el atajo.',
            'name_exists' => 'El nombre del atajo ya existe',
            'must_include' => 'Este campo es obligatorio.'
        ],
        'exceptions' => [
            'not_found' => 'El atajo no existe o no está disponible',
        ],
    ]


];
