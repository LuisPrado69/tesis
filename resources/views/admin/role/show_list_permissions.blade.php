<li>
    @if($allowed == 'true')
        <span class="label label-success">
            {{ $label }} <i class="fa fa-check"></i>
        </span>
    @else
        <span class="label label-default">
            {{ $label }} <i class="fa fa-times"></i>
        </span>
    @endif

    @if(isset($menus) && $menus)
        @foreach($menus as $menu)
            <ul>
                <li>
                    @if($menu['allowed'] == 'true')
                        <span class="label label-success">
                            {{ $menu['label'] }} <i class="fa fa-check"></i>
                        </span>
                    @else
                        <span class="label label-default">
                            {{ $menu['label'] }} <i class="fa fa-times"></i>
                        </span>
                    @endif
                </li>
            </ul>
        @endforeach
    @endif
</li>