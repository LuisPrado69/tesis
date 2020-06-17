<div class="modal-content">
    <div class="modal-header">
        @if(session('changedPassword'))
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
            </button>
        @endif
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key"></i> {{trans('users.user.title_change_password')}}</h4>
    </div>
    
    <form id="change_password_fm" class="form-horizontal" role="form" method="POST"
          action="{{ route('update.password.profile') }}" autocomplete="off" novalidate>
        @csrf
        <input type="hidden" name="changed_password" value="1">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password">
                            {{ trans('users.user.labels.password') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="password" name="password" id="password" required
                                   class="form-control col-md-7 col-xs-12"
                                   placeholder="{{ trans('users.user.placeholders.password') }}"/>
                        </div>
                    </div>
                    
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password_confirm">
                            {{ trans('users.user.labels.password_confirm') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="password" name="password_confirm" id="password_confirm" required
                                   class="form-control col-md-7 col-xs-12"
                                   placeholder="{{ trans('users.user.placeholders.password_confirm') }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            @if(session('changedPassword'))
                <button type="button" class="btn btn-info ajaxify" data-dismiss="modal"> {{ trans('app.labels.cancel') }}</button>
            @endif
            <button type="submit" class="btn btn-success"> {{ trans('app.labels.accept') }}</button>
        </div>
    </form>
</div>

<script>
    $(function() {
        let $form = $('#change_password_fm');

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirm: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password_confirm : {
                    equalTo : '{!! trans('users.user.messages.validation.password_not_equal') !!}'
                }
            }
        }));
        $form.ajaxForm({
            beforeSubmit: function() {
                showLoading();
            },
            success: function(response) {
                processResponse(response, null, function() {
                    $('.no-passwd', $modal).removeClass('no-passwd');
                    $modal.removeAttr('data-backdrop');
                    $modal.removeAttr('data-keyboard');
                    $modal.modal('hide');
                });
            },
            error: function(param1, param2, param3) {
                notify(param3, 'error', 'Error!');
            },
            complete: function() {
                hideLoading();
            }
        });
    });
</script>

