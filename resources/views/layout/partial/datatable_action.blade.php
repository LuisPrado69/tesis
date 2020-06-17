<!--
Layout for Datatables actions. The usage of each variable will be:

1. $actions. For each $action:

Each action's key, will represent the icon ($icon) of the button. Use Font Awesome icons.

$action['route'] : (Mandatory) defines the URL that will be called when user clicks the button.
$action['method']: (Optional) If not sent, the default will be GET.
$action['confirm_message'] : (Optional) If sent, a confirmation modal will be raised with the sent message.
$action['tooltip']: (Optional) If sent, the button icon will have a tooltip.
$action['btn_class']: (Optional) If sent, the link of the button will have a CSS class, to work with.
$action['post_action']: (Optional) If sent, a Javascript callback can be sent to be excuted after the Back-end sends a response. Example  '$("#publish_vacants_tb").DataTable().draw();'

2. $entity

The database object that represents the entity that will be manipulated with the current actions.

3. $params

The route might need some other parameters other than the ID. An array of Route Parameters can be sent here.

-->
<div class="actions">
    @foreach($actions as $icon => $action)

        <a id="{{ explode('.', $action['route'])[0] . $entity->id }}"
           class="btn btn-xs @if(isset($action['btn_class'])) {{ $action['btn_class'] }} @else btn-primary @endif {{ explode('.', $action['route'])[0] . $entity->id }}"
           role="button"
           data-toggle="tooltip" data-placement="top" data-original-title="{{ $action['tooltip'] ?? '' }}" >
            <i class="fa fa-{{ $icon }}"></i>
        </a>

        <script>

            let class_id = '{!! explode('.', $action['route'])[0] . $entity->id !!}';

            $('.' + class_id).on('click', function(e) {
                e.preventDefault();

                $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
                let url = "";

                @if(isset($params))
                    url = '{!! route ($action['route'], $params) !!}';
                @else
                    url = '{!! route ($action['route'], ['id' => $entity->id]) !!}';
                @endif

                let method = '{!! isset($action['method']) ? $action['method'] : null !!}';

                @if(isset($action['confirm_message']))
                    let confirmMessage = '{!! $action['confirm_message'] !!}';

                    confirmModal(confirmMessage, function() {
                        pushRequest(url, null, function() {
                            @if(isset($action['post_action']))
                                {!! $action['post_action'] !!}
                            @endif
                        }, method, {'_token': '{{ csrf_token() }}' });
                    });
                @else
                    pushRequest(url, null, function() {
                        @if(isset($action['post_action']))
                            {!! $action['post_action'] !!}
                        @endif
                    }, method, {'_token': '{{ csrf_token() }}' });
                @endif
            });
        </script>
    @endforeach
</div>