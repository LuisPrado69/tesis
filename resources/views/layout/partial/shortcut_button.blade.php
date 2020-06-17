@forelse ($shortcuts as $i => $shortcut)
    <li style="display: inline-flex">
        <a class="ajaxify" href="{{ fullUrl($shortcut->URL) }}">
            <span>
                <strong>{!! str_limit($shortcut->name, $limit = 40, $end = '...') !!}</strong>
            </span>
        </a>
        <a class="ajaxify delete-btn text-right" id="delete-shortcut-btn-{{ $shortcut->id }}" style="width: 10%;">
            <i class="fa fa-times"></i>
        </a>
    </li>

    <script>
        if ($("#delete-shortcut-btn-{{ $shortcut->id }}")) {
            $("#delete-shortcut-btn-{{ $shortcut->id }}").on("click", function() {
                pushRequest('{!! route('destroy.shortcut', ['id' => $shortcut->id]) !!}', null, function(response) {
                    refreshUIFromButton('{{ $shortcut->URL }}', '{{ $shortcut->widget_id }}', '{{ $shortcut->name }}' );
                }, 'delete', {
                    _token: '{{ csrf_token() }}',
                    id: '{!! $shortcut->id!!}'
                });
            });
        }
    </script>

@empty
    <li class="align-center">
        <span>
            <strong>{{ trans('shortcuts.labels.empty_shortcuts') }}</strong>
        </span>
    </li>
@endforelse

@if(count($shortcuts) > 0)
<li>
    <div class="text-center">
        <a class="ajaxify" href="{{ route('index.shortcut')}}">
            <strong>{{ trans('shortcuts.labels.see_all') }}</strong>
        </a>
    </div>
</li>
@endif

<script>
    function refreshUIFromButton(url, widget_id, default_name) {
        pushRequest('{!! route('navbar.shortcut')!!}', '#shortcut_menu');
        pushRequest('{!! route('widget.shortcut') !!}', '#shortcut_widget_' + widget_id, null, 'get', {
            _token: '{{ csrf_token() }}',
            URL: url,
            widget_id: widget_id,
            default_name: default_name
        });
    }
</script>