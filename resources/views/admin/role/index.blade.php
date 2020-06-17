@permission('index.roles')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('roles.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-ol"></i> {{ trans('roles.list') }}
                    </h2>
                    @permission('create.roles')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.roles') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('roles.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a id="admin_roles_delete_btn" class="btn btn-danger" data-toggle="tooltip" data-placement="right" data-original-title="">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a id="admin_roles_enabled_btn" class="btn btn-success" data-toggle="tooltip" data-placement="right" data-original-title="">
                                <i class="fa fa-check-square-o"></i>
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped" id="admin_roles_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th><input type="checkbox" class="bulk check-all"/></th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
                            <th>{{ trans('app.headers.enabled') }}</th>
                            <th>{{ trans('app.headers.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        let $table = $('#admin_roles_tb');
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.roles') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', sortable: false, searchable: false, width: '5%', class: 'text-center'},
                {data: 'name', width: '30%'},
                {data: 'description', width: '40%'},
                {data: 'enabled', width: '15%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function(e) { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(this).is(':checked') ? '{{ trans('roles.messages.confirm.status_on') }}' : '{{ trans('roles.messages.confirm.status_off') }}';
            let element = $(this);

            confirmModal(confirmMessage, function() {

                let id = element.closest('tr').attr('id');

                let url = "{!! route('status.roles', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, function() {
                    datatable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}'
                });
            });
        });

        $('#admin_roles_delete_btn').on('click', function(e) {
            e.preventDefault();

            let confirmMessage = '{!! trans('roles.messages.confirm.delete_bulk') !!}';

            confirmModal(confirmMessage, function() {
                let checked = $("input[name='table_records']:checked", $table);
                let ids = [];

                checked.each(function() {
                    let id = $(this).closest('tr').attr('id');
                    ids.push(id);
                });

                pushRequest('{!! route('bulk.destroy.roles') !!}', null, function() {
                    datatable.draw();
                }, 'delete', {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                });
            });
        });

        $('#admin_roles_enabled_btn').on('click', function(e) {
            e.preventDefault();

            let confirmMessage = '{!! trans('roles.messages.confirm.status_bulk') !!}';

            confirmModal(confirmMessage, function() {

                let checked = $("input[name='table_records']:checked", $table);
                let ids = [];

                checked.each(function() {
                    let id = $(this).closest('tr').attr('id');
                    ids.push(id);
                });

                pushRequest('{!! route('bulk.status.roles') !!}', null, function() {
                    datatable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                });
               
            });
        });

    });
</script>

@else
    @include('errors.403')
    @endpermission