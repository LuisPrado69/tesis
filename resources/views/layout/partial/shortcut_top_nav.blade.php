<li role="presentation" class="dropdown hidden">
    <a href="javascript:" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="glyphicon glyphicon-star-empty"
           data-toggle="tooltip" data-placement="bottom" data-original-title="{{trans('app.labels.shortcuts')}}"></i>
    </a>
    <ul id="shortcut_menu" class="dropdown-menu list-unstyled msg_list " role="menu">
        @include('layout.partial.shortcut_button')
    </ul>
</li>