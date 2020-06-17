<div class="inbox-body" data-s>
    <div class="mail_heading row">
        <div class="col-md-12 text-right">
            <p class="date"> </p>
        </div>
        <a id="delete-notification-btn" class="btn btn-box-tool ajaxify" style="float: right;">
            <i class="fa fa-trash text-danger"></i>
        </a>
        <div class="col-md-12">
            {{ trans('notification.labels.subject') }}:
            <h4 style="margin-top: 5px !important;"> {{$notification->subject}}</h4>
        </div>
    </div>
    <div class="sender-info">
        <div class="row">
            <div class="col-md-12">
                {{ trans('notification.labels.from') }}: <strong>{{$notification->sender->fullName()}}</strong>
            </div>
        </div>
    </div>
    <br/>
    <div class="view-mail">
        <p> {!! $notification->body !!} </p>
    </div>
</div>

<script>
    if (document.getElementById("delete-notification-btn")) {
        document.getElementById("delete-notification-btn").addEventListener("click", function(e) {
            e.preventDefault();
            if (confirm('{{ html_entity_decode(trans('notification.messages.confirm.delete')) }}')) {
                pushRequest('{!! route('destroy.notification', ['id' => $notification->id]) !!}', null, function(response) {
                    refreshUINotifications();
                }, 'delete', {
                    _token: '{{ csrf_token() }}',
                    id: '{!! $notification->id!!}'
                });
            }
        });
    }

    function refreshUINotifications() {
        pushRequest('{{ route('index.notification') }}');
    }
</script>

