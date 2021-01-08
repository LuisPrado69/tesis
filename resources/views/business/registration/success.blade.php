@extends('business.registration.index')

@section('body')
    <div class="wrapper d-flex justify-content-center align-items-center">
        <div class="panel panel-success wrapper_content col-md-6 col-sm-6 col-xs-11" style="padding: 0">
            <div class="panel-heading">
                <div class="text-center">
                    <h1>
                        {{ trans('registration.registration_successfully') }}
                    </h1>
                </div>
            </div>
            <div class="panel-body" style="text-align: center; color: #000;">
                <h4>{{ trans('registration.check_email') }}</h4>
                <br>
            </div>
        </div>
    </div>

    <script>
        (function (global) {

            if(typeof (global) === "undefined") {
                throw new Error("window is undefined");
            }

            var _hash = "!";
            var noBackPlease = function () {
                global.location.href += "#";

                // making sure we have the fruit available for juice (^__^)
                global.setTimeout(function () {
                    global.location.href += "!";
                }, 50);
            };

            global.onhashchange = function () {
                if (global.location.hash !== _hash) {
                    global.location.hash = _hash;
                }
            };

            global.onload = function () {
                noBackPlease();

                // disables backspace on page except on input fields and textarea..
                document.body.onkeydown = function (e) {
                    var elm = e.target.nodeName.toLowerCase();
                    if (e.key === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                        e.preventDefault();
                    }
                    // stopping event bubbling up the DOM tree..
                    e.stopPropagation();
                };
            }

        })(window);
    </script>
@endsection