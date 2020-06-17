@permission('edit.users')
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
                    <a class="ajaxify" href="{{ route('index.users') }}"> {{ trans('users.user.title') }}</a>
                </li>
                @endpermission
                <li class="active"> {{ trans('app.labels.update') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-user"></i> {{ trans('users.user.labels.update') }}
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
                    <form role="form" action="{{ route('update.edit.users', ['id' => $entity->id]) }}" method="post"
                          class="form-horizontal form-label-left" id="adminUserUpdateFm" novalidate>
                        @method('PUT')
                        @csrf
                        <span class="section">{{ trans('users.user.labels.profile_title') }}</span>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first_name">
                                    {{ trans('users.user.labels.first_name') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="first_name" id="first_name" maxlength="50"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           placeholder="{{ trans('users.user.labels.first_name') }}"
                                           value="{{ $entity->first_name }}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="last_name">
                                    {{ trans('users.user.labels.last_name') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="last_name" id="last_name" maxlength="50"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           placeholder="{{ trans('users.user.labels.last_name') }}"
                                           value="{{ $entity->last_name }}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="document_type">
                                    {{ trans('app.labels.document_type') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select class="form-control" name="document_type" id="document_type">
                                        <option value=""></option>
                                        <option value="CED" @if($entity->document_type == 'CED') selected @endif>{{ trans('app.labels.identification_card') }}</option>
                                        <option value="PAS" @if($entity->document_type == 'PAS') selected @endif>{{ trans('app.labels.passport') }}</option>
                                        <option value="RUC" @if($entity->document_type == 'RUC') selected @endif>{{ trans('app.labels.ruc') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="document">
                                    {{ trans('app.labels.document') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="document" id="document" maxlength="20"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           placeholder="{{ trans('users.user.placeholders.document') }}"
                                           value="{{ $entity->document }}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">
                                    {{ trans('users.user.labels.email') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="email" id="email"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           placeholder="{{ trans('users.user.labels.email') }}"
                                           value="{{ $entity->email }}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="photo" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    {{ trans('users.user.labels.photo') }}
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="file" name="photo" id="photo"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           accept="image/png, image/jpeg, image/jpg"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="roles">
                                    {{ trans('roles.labels.role') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select class="select2_multiple_roles form-control" name="roles" id="roles" @if($entity->id == currentUser()->id) disabled @endif>
                                        <option></option>
                                        @foreach($roles as $role)
                                            @if($role->enabled)
                                            <option value="{{ $role->id }}"@if($entity->hasRole($role->slug)) selected @endif>
                                                {{ $role->name }}
                                            </option>
                                            @elseif($entity->hasRole($role->slug))
                                                <option value="{{ $role->id }}"@if($entity->hasRole($role->slug)) selected @endif>
                                                    {{ $role->name.' '.trans('app.labels.disabled') }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="username">
                                    {{ trans('users.user.labels.username') }} <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input name="username" id="username" maxlength="20"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           placeholder="{{ trans('users.user.placeholders.username') }}"
                                           value="{{ $entity->username }}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="enabled">
                                    {{ trans('app.headers.enabled') }}
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="checkbox" name="enabled" id="enabled" class="js-switch" @if($entity->enabled) checked
                                           @endif @if($entity->id == currentUser()->id) disabled @endif/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                            <img src="{{ asset($entity->photoPath()) }}" alt="{{ trans('users.user.labels.photo') }}"
                                 class="img-responsive avatar-view" style="width: 100%;">
                        </div>
                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            @permission('index.users')
                            <a href="{{ route('index.users') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            @endpermission
                            <button id="submitButton" type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.accept') }}
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
        let $adminUserUpdateFm = $('#adminUserUpdateFm');

        let validator = $adminUserUpdateFm.validate($.extend(false, $validateDefaults, {
            rules: {
                first_name: {
                    required: true,
                    lettersOnly: true
                },
                last_name: {
                    required: true,
                    lettersOnly: true
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
                                return $('#document', $adminUserUpdateFm).val();
                            },
                            model: 'App\\Models\\System\\User',
                            current: '{{ $entity->id }}'
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
                                return $('#email', $adminUserUpdateFm).val();
                            },
                            model: 'App\\Models\\System\\User',
                            current: '{{ $entity->id }}'
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
                                return $('#username', $adminUserUpdateFm).val();
                            },
                            model: 'App\\Models\\System\\User',
                            current: '{{ $entity->id }}'
                        }
                    }
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

        $adminUserUpdateFm.ajaxForm($formAjaxDefaults);

        // select role
        $("#roles", $adminUserUpdateFm).select2({
            placeholder: '{{ trans('users.user.labels.select_role') }}'
        });

        // select document type
        $("#document_type", $adminUserUpdateFm).select2({
            placeholder: '{{ html_entity_decode(trans('users.user.placeholders.document_type')) }}',
            minimumResultsForSearch: -1,
        });

        $("#document_type", $adminUserUpdateFm).on('change', function () {
            checkDocument($(this).val());

            validator.element($("#document", $adminUserUpdateFm));
        });

        $('select').on('change', function () {
            validator.element($(this));
        });

        checkDocument($("#document_type", $adminUserUpdateFm).val());
    });

    function checkDocument(value) {
        let $document = $("#document");
        switch (value) {
            case 'CED' :
                $document.rules("remove", "passport ruc");

                $document.rules("add", {
                    cedula: true
                });

                break;
            case 'PAS' :
                $document.rules("remove", "cedula ruc");

                $document.rules("add", {
                    passport: true
                });

                break;
            case 'RUC' :
                $document.rules("remove", "cedula passport");

                $document.rules("add", {
                    ruc: true
                });
        }
    }
</script>

@else
    @include('errors.403')
    @endpermission