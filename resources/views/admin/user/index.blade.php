@permission('index.users')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('users.user.title') }}
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
                        <i class="fa fa-users"></i> {{ trans('users.user.list') }}
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        @permission('create.users')
                        <li class="pull-right">
                            <a href="{{ route('create.users') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('users.user.labels.create') }}
                            </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="clearfix"></div>

                </div>

                <div class="x_content">
                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @permission('destroy.users')
                            <a id="usersRecycleBtn" class="btn btn-danger"
                               data-entities="{{ strtolower(trans('users.user.title')) }}"
                               data-toggle="tooltip" data-placement="right" data-original-title="">
                                <i class="fa fa-recycle"></i>
                            </a>

                            <script>
                                $(function() {
                                    $('#usersRecycleBtn').on('click', function(e) {
                                        e.preventDefault();

                                        let $adminUsersTb = $('#users_tb');

                                        confirmModal("{{ html_entity_decode(trans('users.user.messages.confirm.delete_bulk')) }}",
                                            function() {
                                                let checked = $("input[name='table_records']:checked", $adminUsersTb);
                                                let ids = [];

                                                checked.each(function() {
                                                    let id = $(this).closest('tr').attr('id');
                                                    ids.push(id);
                                                });

                                                pushRequest('{!! route('bulk.destroy.users') !!}', null, function() {
                                                    $adminUsersTb.DataTable().draw();
                                                }, 'delete', {
                                                    _token: '{{ csrf_token() }}',
                                                    ids: ids
                                                });
                                            }
                                        )
                                    });
                                });
                            </script>
                            @endpermission

                            @permission('status.users')
                            <a id="users_enabled_btn" class="btn btn-success" data-toggle="tooltip"
                               data-placement="right" data-original-title="">
                                <i class="fa fa-exchange"></i>
                            </a>

                            <script>
                                $(function() {
                                    $('#users_enabled_btn').on('click', function(e) {
                                        e.preventDefault();

                                        let $table = $('#users_tb');

                                        confirmModal('{{ html_entity_decode(trans('users.user.messages.confirm.status_bulk')) }}',
                                            function() {
                                                let checked = $table.find("input[name='table_records']:checked");
                                                let ids = [];

                                                checked.each(function() {
                                                    let id = $(this).closest('tr').attr('id');
                                                    ids.push(id);
                                                });

                                                pushRequest('{!! route('bulk.status.users') !!}', null, function() {
                                                    $table.DataTable().draw();
                                                }, 'put', {
                                                    _token: '{{ csrf_token() }}',
                                                    ids: ids
                                                });

                                            });
                                    });
                                });
                            </script>
                            @endpermission
                        </div>
                    </div>

                    <table class="table table-striped" id="users_tb">
                        <thead>
                            <tr>
                                <th></th>
                                @if(currentUser()->can('status.users'))
                                    <th><input type="checkbox" class="bulk check-all"
                                               title="{{ trans('app.labels.select_all') }}"/></th>
                                @endif
                                <th>{{ trans('users.user.labels.full_name') }}</th>
                                <th>{{ trans('users.user.labels.username') }}</th>
                                <th>{{ trans('users.user.labels.role') }}</th>
                                <th>{{ trans('app.headers.enabled') }}</th>
                                <th>{{ trans('app.labels.actions') }}</th>
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

        let $dataTable = build_datatable($('#users_tb'), {
            ajax: '{!! route('data.index.users') !!}',
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                    @if(currentUser()->can('status.users'))
                {
                    data: 'bulk_action', width: '5%', sortable: false, searchable: false, class: 'text-center'
                },
                    @endif
                {
                    data: 'name', width: '20%', searchable: true, sortable: false
                },
                {data: 'username', width: '20%', searchable: true},
                {data: 'role', width: '20%', searchable: true, sortable: false},
                {data: 'enabled', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function(e) { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(this).is(':checked') ? '{{ trans('users.user.messages.confirm.status_on') }}' : '{{ trans('users.user.messages.confirm.status_off') }}';
            let element = $(this);

            confirmModal(confirmMessage, function() {

                let id = element.closest('tr').attr('id');
                let url = "{!! route('status.users', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, function() {
                    $dataTable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}'
                });
            });
        });
    });

</script>

@else
    @include('errors.403')
    @endpermission
