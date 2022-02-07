@extends('layout.base')

@section('styles')
    <link href="{{ asset('assets/vendor/gentelella/vendors/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/vendors/font-awesome/css/font-awesome.css.map') }}"
          rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css.map') }}"
          rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/css/custom.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet"/>
    <link href="{{ mix('assets/css/theme.css') }}" rel="stylesheet"/>
    <!-- Custom -->
    <link href="{{ mix('assets/css/login.css') }}" rel="stylesheet"/>
@endsection

@push('body_classes') login-page @endpush

@section('body')
    <div>
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper" class="login_wrapper form d-flex justify-content-center align-items-center"
             style="max-width: none; background-color: #eee">
            <div id="login" style="background-color: white; border-radius: 6px">
                <section class="login_content">
                    <form id="login_fm_first" role="form" action="{{ route('login') }}" method="post"
                          class="form-horizontal">
                        <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
                            <img src="{{ asset($logos['login_logo']) }}" class="img-responsive" style="width: 100%"/>
                        </div>
                        @csrf
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                            <br>
                            @if($timeout = session('session_time_out'))
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            {{ $timeout }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="item form-group" style="margin-bottom: 20px">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" style="width: 85%; margin: auto; border-radius: 20px"
                                           name="username" id="username" value="{{ old('username') }}"
                                           placeholder="{!! trans('users.user.placeholders.username') !!}">
                                </div>
                            </div>
                            <div class="item form-group" style="margin-bottom: 20px">
                                <div class="col-xs-12">
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="{!! trans('users.user.placeholders.password') !!}"
                                           style="width: 85%; margin: auto; border-radius: 20px">
                                </div>
                            </div>
                            <div class="item form-group" style="margin-bottom: 10px; border-radius: 20px">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary submit" style="margin-bottom: 10px; width: 85%; border-radius: 20px">
                                        {{trans('app.labels.login')}}
                                    </button>
                                </div>
                                <div class="col-xs-12">
                                    <a href="{{ route('password.reset') }}" style="font-size: 13px;color: #337ab7;text-decoration: none;">
                                        {{ trans('auth.forget_password') }}
                                    </a>
                                </div>
                            </div>
                            <div class=" col-xs-12">
                                <br/>
                                <br/>
                                <p>
                                    <strong>&copy; @actualyear {{ $labels['footer'] }}</strong>
                                </p>
                            </div>
                        </div>
                    </form>

                    <div class="col-xs-12">
                        <a href="{{ url('download.app') }}" target="_b">
                            Download
                        </a>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/localization/messages_es.js') }}"></script>
    <script src="{{ asset('assets/vendor/gentelella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script>
        $(function () {

            $("#username").focus();

            let stack_center = {
                "dir1": "down",
                "dir2": "right"
            };

            @if ($errors->has('username'))
            new PNotify({
                title: 'Error accediendo al sistema',
                type: 'error',
                text: '{{ $errors->first('username') }}',
                styling: 'bootstrap3',
                stack: stack_center,
                delay: 4000
            });
            @endif

            @if ($errors->has('email'))
            new PNotify({
                title: 'Atención',
                type: 'success',
                text: '{{ $errors->first('email') }}',
                styling: 'bootstrap3',
                stack: stack_center,
                delay: 5000
            });
            @endif

            $('#login_fm_first').validate({
                ignore: [],
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error').removeClass('has-success');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    $('button[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            });

            $('html').css('background-color', '#eee');
            $('#login').css('box-shadow', '0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2)');
        });
    </script>
@endsection