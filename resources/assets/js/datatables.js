/**
 * Datatables
 **/
(function($, DataTable) {
    $.extend(true, DataTable.defaults, {
        dom: '<lf<t>ipr>',
        bProcessing: true,
        bServerSide: true,
        bAutoWidth: false,
        responsive: true,
        oLanguage: {
            "sProcessing": "<i class='fa fa-spinner fa-spin'></i>",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&#250;n dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<i class='fa fa-spinner fa-spin'></i>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "&#218;ltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
})(jQuery, jQuery.fn.DataTable);

function build_datatable($table, $config, onEnabledSwitchChange) {
    $.fn.dataTable.ext.errMode = 'none';
    showLoading();

    return $table
        .DataTable($config)
        .on('draw.dt', function() {

            /** initialize actions tooltip */
            init_tooltip($table);

            /** switches for enabled/disabled entities */
            init_switchery($table);
            $table.find('.js-switch-enabled').on('click', onEnabledSwitchChange);

            /** checks for bulk actions */
            let $checks = $("input.bulk", $table);
            if ($checks[0]) {
                $checks.iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });

                let $checksOne = $('input.check-one', $table);
                let $checksAll = $('input.check-all', $table);


                $checks.on('ifChecked', function() {
                    let $this = $(this);

                    if ($this.hasClass('check-all'))
                        $("input[name='table_records']", $table).iCheck('check');

                    else if ($this.hasClass('check-one')) {
                        $this.closest('tr').addClass('selected');

                        if ($("input[class*='check-one']:checked", $table).length === $checksOne.length) {
                            $checksAll.prop('checked', true);
                            $checksAll.iCheck('update');
                        }
                    }

                    _options();
                });

                $checks.on('ifUnchecked', function() {
                    let $this = $(this);

                    if ($this.hasClass('check-all'))
                        $("input[name='table_records']", $table).iCheck('uncheck');

                    else if ($this.hasClass('check-one')) {
                        $this.closest('tr').removeClass('selected');

                        if ($("input[class*='check-one']:checked", $table).length !== $checksOne.length) {
                            $checksAll.prop('checked', false);
                            $checksAll.iCheck('update');
                        }
                    }

                    _options();
                });

                _options();

                function _options() {
                    let wrapper = '#' + $table.prop('id') + '_wrapper';
                    let $length = $('.dataTables_length', wrapper);
                    let $filter = $('.dataTables_filter', wrapper);

                    let $bulk = $(wrapper).prev('#bulk-actions');
                    let $info = $("[data-toggle='tooltip']", $bulk);

                    let count = $("input[name='table_records']:checked", $table).length;

                    if (count) {
                        $length.hide();
                        $filter.hide();
                        $bulk.show();
                        $bulk.find('a.btn-success').attr('data-original-title', 'Habilitar/Inhabilitar elementos seleccionados');
                        $bulk.find('a.btn-danger').attr('data-original-title', 'Eliminar elementos seleccionados');

                    } else {
                        $bulk.hide();
                        $filter.show();
                        $length.show();
                        $info.attr('data-original-title', '');
                    }
                }
            }
            hideLoading();
        });
}
