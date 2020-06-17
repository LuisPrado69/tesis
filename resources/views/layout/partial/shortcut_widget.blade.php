<div id="shortcut_widget_{{$widget_id}}" role="presentation" class="left dropdown shortcut-list-toggle">
    @if($isShortcutSaved)
        <i id="delete-shortcut-btn-{{$widget_id}}" class="fa fa-star shortcut-icon shortcut-saved"></i>
    @else
        <a href="#" class="dropdown-toggle info-number" data-toggle="dropdown"
           aria-expanded="false">
            <i class="fa fa-star-o shortcut-icon" data-toggle="tooltip" data-placement="bottom"
               data-original-title="{{trans('app.labels.add_to_shortcuts')}}"></i>
        </a>

        <ul id="menu1" class="dropdown-menu list-unstyled msg_list shortcut-list" role="menu">
            <li id="name-input-li" style="display: @if (!$isShortcutSaved) flex @else none @endif !important;">
                <div class="form-group shortcut-form" id="item-{{$widget_id}}">
                    <label class="col-md-12">{{ trans('shortcuts.labels.name') }} <span class="required">*</span>
                    </label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="shortcut-name-{{$widget_id}}" name="name"
                               class="form-control col-md-7 col-xs-12"
                               value="{{$default_name}}" required="true">
                        <span id="name-error-{{$widget_id}}" class="help-block"
                              style="display: none;">{{ trans('shortcuts.messages.errors.must_include') }}</span>
                    </div>
                </div>
            </li>
            <li>
                <div class="text-center" id="shortcut-actions">
                    <a class="ajaxify" id="create-shortcut-btn-{{$widget_id}}">
                        <strong>{{ trans('shortcuts.labels.save') }}</strong>
                    </a>
                </div>
            </li>
        </ul>
    @endif
</div>

<script>
    if ($("#create-shortcut-btn-{{$widget_id}}")) {
        $("#create-shortcut-btn-{{$widget_id}}").on("click", function() {
            pushRequest(
                '{!! route('store.shortcut')!!}',
                null,
                function(response) { refreshUI(); },
                'post',
                {
                    _token: '{{ csrf_token() }}',
                    name: $('#shortcut-name-{{$widget_id}}').val(),
                    URL: '{{$URL}}',
                    user_id: '{{ currentUser()->id }}',
                    widget_id: '{{$widget_id}}',
                    default_name: '{{$default_name}}'
                }
            );
        });
    }

    if ($("#delete-shortcut-btn-{{$widget_id}}")) {
        $("#delete-shortcut-btn-{{$widget_id}}").on("click", function() {
            pushRequest('{!! route('destroy.shortcut', ['id' => $shortcut->id]) !!}',
                null,
                function(response) { refreshUI(); },
                'delete',
                {
                    _token: '{{ csrf_token() }}',
                    id: '{!! $shortcut->id!!}'
                }
            );
        });
    }

    function refreshUI() {
        pushRequest('{!! route('navbar.shortcut')!!}', '#shortcut_menu');
        pushRequest(
            '{!! route('widget.shortcut')!!}',
            '#shortcut_widget_{{$widget_id}}',
            null,
            'get',
            {
                _token: '{{ csrf_token() }}',
                URL: '{{$URL}}',
                widget_id: '{{$widget_id}}',
                default_name: '{{$default_name}}'
            }
        );
    }

    $('#shortcut-name-{{$widget_id}}').keyup(function() {
        if ($('#shortcut-name-{{$widget_id}}').val().trim().length === 0) {
            $('#name-error-{{$widget_id}}').show();
            $('#item-{{$widget_id}}').addClass('item form-group bad');
        } else {
            $('#name-error-{{$widget_id}}').hide();
            $('#item-{{$widget_id}}').removeClass('item form-group bad');
        }
    });
</script>