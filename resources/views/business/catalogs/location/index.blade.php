@permission('index.location.catalogs')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('location.title') }}
                <small>{{ trans('app.labels.administration') }} / {{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-fort-awesome"></i> {{ trans('location.title') }}
                    </h2>
                    @permission('create.location.catalogs')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.location.catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('location.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped" id="location_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('location.labels.name') }}</th>
                            <th>{{ trans('location.labels.latitude') }}</th>
                            <th>{{ trans('location.labels.longitude') }}</th>
                            <th>{{ trans('location.labels.enabled') }}</th>
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
        let datatable = build_datatable($('#location_tb'), {
            ajax: '{!! route('data.index.location.catalogs') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '30%', sortable: true, searchable: true},
                {data: 'latitude', width: '25%', sortable: true, searchable: true},
                {data: 'longitude', width: '25%', sortable: true, searchable: true},
                {data: 'enabled', width: '10%', searchable: true, sortable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function (e) { // on enabled switch change
            e.preventDefault();
            let confirmMessage = $(this).is(':checked') ? '{{ trans('location.messages.confirm.status_on') }}' : '{{ trans('location.messages.confirm.status_off') }}';
            let element = $(this);
            confirmModal(confirmMessage, function () {
                let id = element.closest('tr').attr('id');
                let url = "{!! route('enable_disable.location.catalogs', ['id' => '__ID__']) !!}";
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