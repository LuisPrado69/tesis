@permission('show.roles')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> {{ trans('roles.labels.details_about', ['name' => $entity->name]) }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#rolInfo">{{ trans('roles.labels.info')}}</a>
                        </h4>
                    </div>
                    <div id="rolInfo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div>
                                <h4 style="margin:.8em 0 0 0;" class="text-dark"><strong>{{trans('roles.labels.role_name')}}:</strong></h4>
                                <p class="text-dark">{{$entity->name}}</p>
                                <h4 style="margin:.8em 0 0 0;" class="text-dark"><strong>{{trans('roles.labels.description')}}:</strong></h4>
                                <p class="text-dark">{{$entity->description}}</p>
                                <h4 style="margin:.8em 0 0 0;" class="text-dark">{{trans('roles.labels.is_enabled_title')}}:</h4>
                                    @if($entity->enabled == '1')
                                        <p class="text-success">
                                            {{trans('roles.labels.is_enabled')}}
                                        </p>
                                    @else
                                        <p class="text-danger">
                                        {{trans('roles.labels.is_not_enabled')}}
                                        </p>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#premissions">{{ trans('roles.labels.permissions_title')}} </a>
                        </h4>
                    </div>
                    <div id="premissions" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach(permissions($entity) as $permission)
                                    <li>
                                        <h4>{{ $permission['label'] }}</h4>
                                        <ul>
                                            @foreach($permission['actions'] as $key => $action)
                                                <li>
                                                    @if($action['allowed'] == 'true')
                                                        <span class="label label-success">
                                            {{ $action['label'] }} <i class="fa fa-check"></i>
                                        </span>
                                                    @else
                                                        <span class="label label-default">
                                            {{ $action['label'] }} <i class="fa fa-times"></i>
                                        </span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#usersInRol">{{ trans('roles.labels.users_in_rol')}} </a>
                        </h4>
                    </div>
                    <div id="usersInRol" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                            @foreach($users as $user)
                             <li style="margin-bottom: 1em;">
                                 <p style="margin:0;"><strong>{{trans('users.user.labels.username')}}:</strong> {{$user->username}}</p>
                                 <p style="margin:0;"><strong>{{trans('users.user.labels.first_name')}}:</strong> {{$user->first_name}} {{$user->last_name}}</p>
                                 <p style="margin:0;"><strong>{{trans('users.user.labels.email')}}:</strong> {{$user->email}}</p>
                             </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission