@permission('permissions.roles')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('roles.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li>
                    <a href="{{ route('index.roles') }}" class="ajaxify"> {{ trans('roles.title') }}</a>
                </li>

                <li class="active"> {{ trans('app.labels.permissions') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-ol"></i> {{ trans('configuration.role.labels.permissions', ['role' => $entity->name]) }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.roles') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('app.labels.close') }}"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="accordion admin-roles-permissions" id="adminRolesAccordion" role="tablist"
                         aria-multiselectable="true">
                        @include('admin.role.edit_list_permissions', ['entity' => $entity])
                    </div>

                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="btn btn-info ajaxify" href="{{ route('index.roles') }}">
                            <i class="fa fa-times"></i> {{ trans('app.labels.close') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        function _allChecked($ul) {
            let checked = true;
            $ul.find('input.js-check-permission').each(function() {
                checked = checked && $(this).is(':checked');
            });

            return checked;
        }

        $('.js-check-all-permissions').each(function () {

            $(this).attr('checked', _allChecked($(this).closest('ul')));

            $(this).on('click', function () {
                let $this = $(this);
                if ($this.attr('data-update')) {
                    $this.removeAttr('data-update');
                } else {
                    let $ul = $this.closest('ul');
                    let base = $ul.attr('id');
                    let checked = $this.is(':checked');
                    let base_second = $ul.attr('base_second');
                    let base_third = $ul.attr('base_third');
                    let base_fourth = $ul.attr('base_fourth');
                    let base_fifth = $ul.attr('base_fifth');
                    let base_sixth = $ul.attr('base_sixth');

                    pushRequest('{!! route('all.permissions.roles') !!}', null, function (response) {
                        if (response.message && response.message.type === 'success') {

                            $ul.find('input.js-check-permission').each(function () {
                                let thisChecked = $(this).is(':checked');

                                if ((checked && !thisChecked) || (!checked && thisChecked)) {
                                    $(this).attr('data-update', true).trigger('click');
                                }
                            });
                            //Marcar o desmarcar tercer nivel
                            $ul.find('input.js-check-all-permissions').each(function () {
                                let thisChecked = $(this).is(':checked');

                                if ((checked && !thisChecked) || (!checked && thisChecked)) {
                                    $(this).attr('data-update', true).trigger('click');
                                }
                            });
                        }
                    }, 'put', {
                        _token: '{{ csrf_token() }}',
                        role: '{{ $entity->slug }}',
                        base: base,
                        checked: checked,
                        base_second: base_second,
                        base_third: base_third,
                        base_fourth: base_fourth,
                        base_fifth: base_fifth,
                        base_sixth: base_sixth
                    }, null, false);
                }
            });
        });

        $('.js-check-permission').on('click', function () {
            let $this = $(this);

            if ($this.attr('data-update')) {
                $this.removeAttr('data-update');
            } else {
                let $ul = $this.closest('ul');
                let base = $ul.attr('id');
                let base_second = $ul.attr('base_second');
                let base_third = $ul.attr('base_third');
                let base_fourth = $ul.attr('base_fourth');
                let base_fifth = $ul.attr('base_fifth');
                let base_sixth = $ul.attr('base_sixth');
                let action = $this.val();

                pushRequest('{!! route('one.permissions.roles') !!}', null, () => {
                    $ul.find('input.js-check-all-permissions').each(function () {
                        let thisChecked = $(this).is(':checked');
                        let allChecked = _allChecked($ul);

                        if ((allChecked && !thisChecked) || (!allChecked && thisChecked)) {
                            $(this).attr('data-update', true).trigger('click');
                        }
                    });
                }, 'put', {
                    _token: '{{ csrf_token() }}',
                    role: '{{ $entity->slug }}',
                    base: base,
                    action: action,
                    base_second: base_second,
                    base_third: base_third,
                    base_fourth: base_fourth,
                    base_fifth: base_fifth,
                    base_sixth: base_sixth
                }, null, false);
            }
        });

        // ----

        $('#adminRolesEnabledSwitch').on('change', function (e) {
            e.preventDefault();
            pushRequest('{!! route('status.roles', ['id' => $entity->id]) !!}', null, null, 'put', {
                _token: '{{ csrf_token() }}'
            }, false);
        });

        $('#adminRolesDeleteBtn').on('click', function (e) {
            e.preventDefault();
            if (confirm('{{ html_entity_decode(trans('roles.messages.confirm.delete')) }}')) {
                pushRequest('{!!  route('destroy.roles', ['id' => $entity->id]) !!}', null, null, 'delete', {
                    _token: '{{ csrf_token() }}'
                }, false);
            }
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission