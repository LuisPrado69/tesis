<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('notification.title') }}</h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li>
                    <a href="{{ route('dashboard.app') }}" class="ajaxify"> {{ trans('app.labels.dashboard') }}</a>
                </li>

                <li class="active"> {{ trans('notification.title') }} </li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <button id="compose" class="btn btn-sm btn-success btn-block" type="button">
                                {{ trans('notification.labels.create') }}
                            </button>
                        </div>
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 mail_list_column">
                            @if(count($notifications) > 0)
                                @foreach($notifications as $notification)
                                    <a class="details" data-id="{{$notification->id}}" style="cursor: pointer">
                                        <div class="mail_list">
                                            <div class="left" style="margin-right: 0">
                                                @if(isset($notification->pivot->read) && !$notification->pivot->read)
                                                    <i class="fa fa-circle"></i>
                                                @else
                                                    <i class="fa fa-circle-thin"></i>
                                                @endif
                                            </div>
                                            <div class="right">
                                                <h3>{{ str_limit($notification->subject, $limit = 40, $end = '...') }}
                                                    <small>{{ $notification->created_at }}</small>
                                                </h3>
                                                <p class="ellipsis">{!! str_limit(strip_tags($notification->body), $limit = 100, $end = '...') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <h5>{{ trans('notification.labels.empty') }}</h5>
                            @endif
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 mail_view" id="detail-done">
                            <!-- ajax -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--compose--}}

    <form role="form" action="{{ route('send.notification') }}" method="post"
          class="form-horizontal form-label-left" id="notification_create_fm">

        @csrf
        <input type="hidden" id="notification_id" name="notification_id" value="{{$notification_id}}">

        <div class="compose col-md-8 col-sm-8 col-xs-12">
            <div class="compose-header">
                {{ trans('notification.labels.new') }}
                <button type="button" class="close compose-close">
                    <span>×</span>
                </button>
            </div>

            <div class="compose-body">
                <div id="alerts"></div>

                <div class="form-group" style="margin-top: 5px;">
                    <label for="subject" class="control-label col-md-2 col-sm-2 col-xs-4">{{ trans('notification.labels.subject') }} :</label>
                    <div class="col-md-6 col-sm-6 col-xs-8">
                        <input type="text" name="subject" id="subject" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label for="users" class="control-label col-md-2 col-sm-2 col-xs-4">{{ trans('notification.labels.recipients') }}:</label>
                    <div class="col-md-6 col-sm-6 col-xs-8">
                        <select class="select2_multiple form-control" multiple name="users[]" id="users">
                        </select>
                    </div>
                </div>

                <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font">
                            <i class="fa fa-font"></i> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                        </ul>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size">
                            <i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a data-edit="fontSize 5">
                                    <p style="font-size:17px">{{ trans('notification.labels.font_big') }}</p>
                                </a>
                            </li>
                            <li>
                                <a data-edit="fontSize 3">
                                    <p style="font-size:14px">{{ trans('notification.labels.font_normal') }}</p>
                                </a>
                            </li>
                            <li>
                                <a data-edit="fontSize 1">
                                    <p style="font-size:11px">{{ trans('notification.labels.font_small') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="btn-group">
                        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                    </div>

                    <div class="btn-group">
                        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                    </div>

                    <div class="btn-group">
                        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                    </div>
                </div>

                <div id="editor" class="editor-wrapper"></div>
                <textarea id="body" name="body" style="display: none"
                          title="{{ trans('notification.placeholders.body') }}"
                          placeholder="{{ trans('notification.placeholders.body') }}">
                </textarea>
            </div>

            <div class="compose-footer">
                <button class="btn btn-sm btn-success" type="submit">
                    <i class="fa fa-send-o"></i> {{ trans('notification.labels.send') }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $(function() {
        let idNotification = "{{$notification_id}}";

        let $form = $('#notification_create_fm');

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {}));
        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                subject: {
                    required: true
                },
                "users[]": {
                    required: true
                },
                body: {
                    required: true
                }
            }
        }));

        if (idNotification !== '')
            loadNotificationDetail(idNotification);

        $(".details").each(function() {
            $(this).click(function() {
                $('.mail_list').removeClass('selected_element');
                $(this).find('.mail_list').addClass('selected_element');
                let id = $(this).attr("data-id");
                loadNotificationDetail(id, $(this));
            });
        });

        $(".select2_multiple").select2({
            ajax: {
                url: "{{route('search_user.notification')}}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.first_name + ' ' + item.last_name,
                                slug: item.id,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 2,
            allowClear: true,
            dropdownCssClass: "notification_select2"
        });

        let $editor = $('#editor');

        $editor.bind("DOMSubtreeModified", function() {
            $('#body').html($editor.html());
        });

        initToolbarBootstrapBindings();

        $editor.wysiwyg({});

        $('#compose, .compose-close').click(function() {
            $('.compose').slideToggle();
        });
    });

    function loadNotificationDetail(value, $this) {
        if (value) {
            let url = '{!! route('show.notification', ['id' => '__ID__']) !!}';
            url = url.replace('__ID__', value);

            $('#notification_id').val(value);

            pushRequest(url, '#detail-done', function(response) {
                if ($this !== undefined)
                    $this.find('i').removeClass('fa-circle').removeClass('fa-circle-thin').addClass('fa-circle-thin');
            });

        } else {
            $('#detail-done').html('');
        }
    }

    function initToolbarBootstrapBindings() {
        let fonts = [
            'Serif',
            'Sans',
            'Arial',
            'Arial Black',
            'Courier',
            'Courier New',
            'Comic Sans MS',
            'Helvetica',
            'Impact',
            'Lucida Grande',
            'Lucida Sans',
            'Tahoma',
            'Times',
            'Times New Roman',
            'Verdana'
        ];

        let fontTarget = $('[title=Font]').siblings('.dropdown-menu');

        $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
        });
    }
</script>
