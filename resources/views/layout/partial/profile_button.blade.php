<li>
    <a href="javascript:" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset(currentUser()->photoPath()) }}" alt="...">
        @currentfullname <span class="fa fa-angle-down"></span>
    </a>
    <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li>
            <a href="javascript:" id="change-passwd-top">
                <i class="fa fa-key pull-right"></i> {{trans('app.labels.change_password')}}
            </a>
        </li>
        <li>
            <a class="ajaxify" href="{{ route('index.profile') }}">
                <i class="fa fa-user pull-right"></i> {{trans('app.labels.profile')}}
            </a>
        </li>
        <li>
            <a href="javascript:" class="logout">
                <i class="fa fa-sign-out pull-right"></i> {{trans('app.labels.exit')}}
            </a>
        </li>
    </ul>
</li>