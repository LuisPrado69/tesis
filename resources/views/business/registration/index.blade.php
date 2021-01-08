<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $labels['system_name'] }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/IconApp.png') }}"/>

    <!-- Styles -->
    <link href="{{ asset('assets/vendor/gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/gentelella/css/custom.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet"/>
    <link href="{{ mix('assets/css/theme.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/registration.css') }}" rel="stylesheet"/>
</head>

<body>
<!-- Scripts -->
<script src="{{ asset('assets/vendor/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-form/jquery.form.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-validation/localization/messages_es.js') }}"></script>
<script src="{{ asset('assets/vendor/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/gentelella/vendors/pnotify/dist/pnotify.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/i18n/es.js') }}"></script>
<script src="{{ asset('assets/js/registration.js') }}"></script>

@yield('body')

<!-- Loading spinner -->
<div id="loading-spinner" class="hidden">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-top: 10px;">
            <i class="fa fa-spinner fa-spin" style="font-size: 5em;"></i>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

</body>
</html>