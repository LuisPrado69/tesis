<li role="presentation" class="dropdown hidden">
    <a href="javascript:" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        @if(count($notifications) > 0)
            <i class="fa fa-bell-o text-success" data-toggle="tooltip" data-placement="bottom" data-original-title="{{trans('app.labels.notifications')}}"></i>
            <span class="badge bg-green">{{ count($notifications) }}</span>
        @else
            <i class="fa fa-bell-o" data-toggle="tooltip" data-placement="bottom" data-original-title="{{trans('app.labels.notifications')}}"></i>
            <span class="badge bg-red">{{ count($notifications) }}</span>
        @endif
    </a>

    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        @foreach($notifications as $i => $notification)
            <li>
                <a class="ajaxify" href="{{ route('index.notification', ['idNotification' => $notification->id]) }}">
                    <span><strong>{!! str_limit($notification->subject, $limit = 40, $end = '...') !!}</strong></span>
                    <span class="message">{!! str_limit(strip_tags($notification->body), $limit = 100, $end = '...') !!}</span>
                </a>
            </li>
        @endforeach
        <li>
            <div class="text-center">
                <a class="ajaxify" href="{{ route('index.notification', ['idNotification' => -1]) }}">
                    <strong>{{ trans('notification.labels.see_all') }}</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    </ul>
</li>