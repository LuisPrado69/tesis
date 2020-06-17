<div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="glyphicon glyphicon-pushpin"></i> {{trans('shortcuts.title')}}
                    </h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row" id="bulk-actions-shortcuts-table" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-danger" id="shortcuts_recycle_btn" data-toggle="tooltip"
                               data-placement="right" data-original-title="">
                                <i class="fa fa-recycle"></i>
                            </a>

                            <script>

                                (function($, DataTable) {
                                    $.extend(true, DataTable.defaults, {
                                        dom: '<lf<t>ip>',
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
                                    return $table
                                        .DataTable($config)
                                        .on('draw.dt', function() {

                                            /** switches for enabled/disabled entities */
                                            init_switchery($table);
                                            $table.find('.js-switch-enabled').on('change', onEnabledSwitchChange);

                                            /** checks for bulk actions */
                                            let $checks = $("input.bulk", $table);
                                            if ($checks[0]) {
                                                $checks.iCheck({
                                                    checkboxClass: 'icheckbox_flat-green'
                                                });

                                                let $checksOne = $('input.check-box-one', $table);
                                                let $checksAll = $('input.check-all-check-box', $table);

                                                $checks.on('ifChecked', function() {
                                                    let $this = $(this);

                                                    if ($this.hasClass('check-all-check-box'))
                                                        $("input[name='table_records_check_box']", $table).iCheck('check');

                                                    else if ($this.hasClass('check-box-one')) {
                                                        $this.closest('tr').addClass('selected');

                                                        if ($("input[class*='check-box-one']:checked", $table).length === $checksOne.length) {
                                                            $checksAll.prop('checked', true);
                                                            $checksAll.iCheck('update');
                                                        }
                                                    }

                                                    _options();
                                                });

                                                $checks.on('ifUnchecked', function() {
                                                    let $this = $(this);

                                                    if ($this.hasClass('check-all-check-box'))
                                                        $("input[name='table_records_check_box']", $table).iCheck('uncheck');

                                                    else if ($this.hasClass('check-box-one')) {
                                                        $this.closest('tr').removeClass('selected');

                                                        if ($("input[class*='check-box-one']:checked", $table).length !== $checksOne.length) {
                                                            $checksAll.prop('checked', false);
                                                            $checksAll.iCheck('update');
                                                        }
                                                    }

                                                    _options();
                                                });

                                                _options();

                                                function _options() {

                                                    let hiddenDiv = document.getElementById("bulk-actions-shortcuts-table");
                                                    let $wrapper = $('.dataTables_wrapper');
                                                    let $length = $('.dataTables_length', $wrapper);
                                                    let $filter = $('.dataTables_filter', $wrapper);

                                                    let $bulk = $('#bulk-actions');
                                                    let $info = $("[data-toggle='tooltip']", $bulk);

                                                    let count = $("input[name='table_records_check_box']:checked", $table).length;

                                                    if (count) {
                                                        $length.hide();
                                                        $filter.hide();
                                                        $bulk.show();
                                                        hiddenDiv.style.display = 'block';
                                                        $info.attr('data-original-title', count + ' elementos seleccionados');

                                                    } else {
                                                        $bulk.hide();
                                                        hiddenDiv.style.display = 'none';
                                                        $filter.show();
                                                        $length.show();
                                                        $info.attr('data-original-title', '');
                                                    }
                                                }
                                            }
                                        });
                                }

                                $(function() {
                                    let $table = $('#shortcuts_table');

                                    $('#shortcuts_recycle_btn').on('click', function(e) {
                                        e.preventDefault();

                                        if (confirm('{{ html_entity_decode(trans('shortcuts.messages.confirm.delete_bulk')) }}')) {
                                            let checked = $("input[name='table_records_check_box']:checked", $table);
                                            let ids = [];

                                            checked.each(function() {
                                                let id = $(this).closest('tr').attr('id');
                                                ids.push(id);
                                            });

                                            pushRequest('{!! route('bulk.destroy.shortcut') !!}', null, function() {
                                                $table.DataTable().draw();
                                                refreshUIFromBulk();
                                            }, 'delete', {
                                                _token: '{{ csrf_token() }}',
                                                ids: ids
                                            });
                                        }
                                    });
                                });

                                function refreshUIFromBulk() {
                                    pushRequest('{!! route('navbar.shortcut')!!}', '#shortcut_menu');
                                    @foreach($shortcuts as $i => $shortcut)
                                    pushRequest('{!! route('widget.shortcut') !!}', '#shortcut_widget_{!! $shortcut->widget_id!!}', null, 'get', {
                                        _token: '{{ csrf_token() }}',
                                        URL: '{!! $shortcut->URL!!}',
                                        widget_id: '{!! $shortcut->widget_id!!}'
                                    });
                                    @endforeach
                                }

                                $('#shortcuts_table').on('click', '.ajaxify', function(e) {
                                    e.preventDefault();

                                    let url = $(this).attr('href') || $(this).attr('data-href');
                                    if (!url)
                                        return;

                                    let target = $(this).attr('data-ajaxify') || '#main_content';

                                    pushRequest(url, target);
                                });

                            </script>
                        </div>
                    </div>

                    <table class="table table-striped" id="shortcuts_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th><input type="checkbox" class="bulk check-all-check-box"/></th>
                            <th>{{ trans('app.headers.name') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        build_datatable($('#shortcuts_table'), {
            ajax: '{!! route('data.index.shortcut') !!}',
            searching: false,
            ordering: false,
            columns: [
                {data: 'id', visible: false, width: '0'},
                {data: 'bulk_action', width: '5%', class: 'text-center'},
                {data: 'name', width: '35%', class: 'text-center'}
            ]
        }, null, '#bulk-actions-shortcuts-table');
    });
</script>

