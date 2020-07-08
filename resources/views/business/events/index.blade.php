@permission('index.events')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('events.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-fort-awesome"></i> {{ trans('events.title') }}
                    </h2>
                    @permission('create.events')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.events') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('events.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped" id="events_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('events.labels.name') }}</th>
                            <th>{{ trans('events.labels.date') }}</th>
                            <th>{{ trans('events.labels.date_start') }}</th>
                            <th>{{ trans('events.labels.date_end') }}</th>
                            <th>{{ trans('events.labels.enabled') }}</th>
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
    $(() => {
        let datatable = build_datatable($('#events_tb'), {
            ajax: '{!! route('data.index.events') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '50%', sortable: true, searchable: true},
                {data: 'date', width: '10%', sortable: true, searchable: true},
                {data: 'date_start', width: '10%', sortable: true, searchable: true},
                {data: 'date_end', width: '10%', sortable: true, searchable: true},
                {data: 'enabled', width: '10%', searchable: true, sortable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function (e) { // on enabled switch change
            e.preventDefault();
            let confirmMessage = $(this).is(':checked') ? '{{ trans('events.messages.confirm.status_on') }}' : '{{ trans('events.messages.confirm.status_off') }}';
            let element = $(this);
            confirmModal(confirmMessage, function () {
                let id = element.closest('tr').attr('id');
                let url = "{!! route('enable_disable.events', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);
                pushRequest(url, null, function () {
                    datatable.draw();
                }, 'get', null);
            });
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission