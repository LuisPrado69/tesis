@extends('business.registration.index')

@section('body')
    <div class="wrapper d-flex justify-content-center align-items-center">
        <div class="wrapper_content" style="width: 40%; padding: 2%">
            <div class="text-center">
                <h3><i class="fa fa-lock fa-4x"></i></h3>
                <h3 class="text-center">{{ trans('auth.forget_password') }}</h3>
                <p>{{ trans('auth.will_send_email') }}</p>
            </div>

            <div class="panel-body">
                <form id="recoveryPasswordFm" role="form" action="{{ route('password.send_email') }}" method="post"
                      class="form-horizontal">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <input type="text" class="form-control col-md-6 col-sm-6 col-xs-12" id="email" name="email"
                                   maxlength="50" placeholder="{{ trans('users.user.labels.email') }}">
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="{{ URL::previous() }}" class="btn btn-warning btn-block">
                                        <i class="fa fa-arrow-circle-left"></i> {{ trans('app.labels.backward') }}
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a class="btn btn-primary btn-block" id="submitButton">{{ trans('auth.send_email') }}</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            let $recover_form = $('#recoveryPasswordFm');

            $recover_form.validate($.extend(false, $validateDefaults, {
                rules: {
                    email: {
                        required: true,
                        emailChecker: true,
                        remote: {
                            url: "{!! route('check.password.email') !!}",
                            data: {
                                email: function () {
                                    return $("#email").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    email: {
                        remote: '{!! trans('auth.email_not_exists') !!}'
                    }
                }
            }));

            $('#submitButton').on('click', function (e) {
                e.preventDefault();
                if ($recover_form.valid()) {
                    showLoading();
                    $recover_form.submit();
                }
            })
        });
    </script>
@endsection