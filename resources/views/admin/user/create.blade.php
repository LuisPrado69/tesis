@permission('create.users')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('users.user.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.users')
                <li>
                    <a href="{{ route('index.users') }}" class="ajaxify"> {{ trans('users.user.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('app.labels.new') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-user"></i> {{ trans('users.user.labels.new') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        @permission('index.users')
                        <li class="pull-right">
                            <a href="{{ route('index.users') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form role="form" action="{{ route('store.create.users') }}" method="post"
                          enctype="multipart/form-data"
                          class="form-horizontal form-label-left" id="adminUserCreateFm" novalidate>

                        @csrf

                        <span class="section">{{ trans('users.user.labels.info') }}</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">
                                {{ trans('users.user.labels.first_name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="first_name" id="first_name" maxlength="50"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.first_name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">
                                {{ trans('users.user.labels.last_name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="last_name" id="last_name" maxlength="50"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.last_name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document_type">
                                {{ trans('app.labels.document_type') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="document_type" id="document_type">
                                    <option value=""></option>
                                    <option value="CED">{{ trans('app.labels.identification_card') }}</option>
                                    <option value="PAS">{{ trans('app.labels.passport') }}</option>
                                    <option value="RUC">{{ trans('app.labels.ruc') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group" id="document_line">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document">
                                {{ trans('app.labels.document') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="document" id="document" maxlength="20"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.document') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                {{ trans('users.user.labels.email') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="email" id="email"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.email') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">
                                {{ trans('users.user.labels.photo') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="photo" id="photo"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       accept="image/png, image/jpeg, image/jpg"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="roles">
                                {{ trans('roles.labels.role') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="roles" id="roles">
                                    <option></option>
                                    @foreach($roles as $role)
                                    @if($role->enabled)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">
                                {{ trans('users.user.labels.username') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="username" id="username" maxlength="20"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.username') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">
                                {{ trans('users.user.labels.password') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" name="password" id="password"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.password') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">
                                {{ trans('users.user.labels.password_confirm') }} <span
                                        class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" name="confirm_password" id="confirm_password"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.password_confirm') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="enabled">
                                {{ trans('app.headers.enabled') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="enabled" id="enabled" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            @permission('index.users')
                            <a href="{{ route('index.users') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            @endpermission
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        let $adminUserCreateFm = $('#adminUserCreateFm');

        let validator = $adminUserCreateFm.validate($.extend(false, $validateDefaults, {
            rules: {
                first_name: {
                    required: true,
                    lettersOnly: true
                },
                last_name: {
                    required: true,
                    lettersOnly:true
                },
                document_type: {
                    required: true
                },
                document: {
                    required: true,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        data: {
                            fieldName: 'document',
                            fieldValue: () => {
                                return $('#document', $adminUserCreateFm).val();
                            },
                            model: 'App\\Models\\System\\User',
                        }
                    }
                },
                email: {
                    required: true,
                    emailChecker: true,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        data: {
                            fieldName: 'email',
                            fieldValue: () => {
                                return $('#email', $adminUserCreateFm).val();
                            },
                            model: 'App\\Models\\System\\User',
                        }
                    }
                },
                photo: {
                    extension: 'jpg|jpeg|png'
                },
                roles: {
                    required: true
                },
                username: {
                    required: true,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        data: {
                            fieldName: 'username',
                            fieldValue: () => {
                                return $('#username', $adminUserCreateFm).val();
                            },
                            model: 'App\\Models\\System\\User',
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                document: {
                    remote: '{!! trans('users.user.messages.validation.document_exists') !!}'
                },
                username: {
                    remote: '{!! trans('users.user.messages.validation.username_exists') !!}'
                },
                email: {
                    remote: '{!! trans('users.user.messages.validation.email_exists') !!}'
                },
                photo: {
                    extension: '{!! trans('users.user.messages.validation.extension') !!}'
                }
            }
        }));

        $adminUserCreateFm.ajaxForm($.extend(false, $formAjaxDefaults, {}));

        // select role
        $("#roles", $adminUserCreateFm).select2({
            placeholder: '{{ trans('users.user.labels.select_role') }}',
            minimumResultsForSearch: -1,
        });

        // select document type
        $("#document_type", $adminUserCreateFm).select2({
            placeholder: '{{ html_entity_decode(trans('users.user.placeholders.document_type')) }}',
            minimumResultsForSearch: -1,
        });

        $("#document_type", $adminUserCreateFm).on('change', function () {
            switch (this.value) {
                case 'CED' :
                    $("#document", $adminUserCreateFm).rules("remove", "passport ruc");

                    $("#document", $adminUserCreateFm).rules("add", {
                        cedula: true
                    });

                    break;
                case 'PAS' :
                    $("#document", $adminUserCreateFm).rules("remove", "cedula ruc");

                    $("#document", $adminUserCreateFm).rules("add", {
                        passport: true
                    });

                    break;
                case 'RUC' :
                    $("#document", $adminUserCreateFm).rules("remove", "cedula passport");

                    $("#document", $adminUserCreateFm).rules("add", {
                        ruc: true
                    });
            }

            validator.element($("#document", $adminUserCreateFm));
        });

        $('select').on('change', function () {
            validator.element($(this));
        });

        $('#document').on('blur', function () {
            if($('#username').val() == '' || $('#username').val() != $(this).val())
                $('#username').val($(this).val());
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission