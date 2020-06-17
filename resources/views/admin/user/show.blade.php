@permission('show.users')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-address-card"></i> {{trans('users.user.labels.info')}}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form class="form-horizontal form-label-left">

                <span class="section">{{ trans('users.user.labels.profile_title') }}</span>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first_name">
                            {{ trans('users.user.labels.first_name') }} :
                        </label>

                        <label class="control-label" for="first_name" style="font-weight: normal">
                            {{ $entity->first_name }}
                        </label>

                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="last_name">
                            {{ trans('users.user.labels.last_name') }} :
                        </label>
                        <label class="control-label" for="last_name" style="font-weight: normal">
                            {{ $entity->last_name }}
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="document_type">
                            {{ trans('app.labels.document_type') }} :
                        </label>
                        <label class="control-label" for="document_type" style="font-weight: normal">
                            @if($entity->document_type == 'CED')
                                {{ trans('app.labels.identification_card') }}
                            @elseif($entity->document_type == 'PAS')
                                {{ trans('app.labels.passport') }}
                            @else
                                {{ trans('app.labels.ruc') }}
                            @endif
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="document">
                            {{ trans('app.labels.document') }} :
                        </label>
                        <label class="control-label" for="document" style="font-weight: normal">
                            {{ $entity->document }}
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">
                            {{ trans('users.user.labels.email') }} :
                        </label>
                        <label class="control-label" for="email" style="font-weight: normal">
                            {{ $entity->email }}
                        </label>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="username">
                            {{ trans('users.user.labels.username') }} :
                        </label>
                        <label class="control-label" for="username" style="font-weight: normal">
                            {{ $entity->username }}
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="enabled">
                            {{ trans('app.headers.enabled') }} :
                        </label>
                        <label class="control-label">
                            <i class="fa @if($entity->enabled) fa-check text-success @else fa-times text-danger @endif"></i>
                        </label>
                    </div>

                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                    <img src="{{ asset($entity->photoPath()) }}" alt="{{ trans('users.user.labels.photo') }}"
                         class="img-responsive avatar-view" style="width: 100%;">
                </div>

                <div class="clearfix"></div>
                <span class="section">{{ trans('app.labels.info_system') }}</span>
                @foreach($entity->roles as $rol)
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="roles">
                        {{ trans('roles.labels.role') }} :
                    </label>
                    <label class="control-label" for="roles" style="font-weight: normal">
                        {{ $rol->name }}
                    </label>
                </div>
                @endforeach
            </form>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission