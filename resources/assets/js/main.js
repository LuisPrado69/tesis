/* No back button */
window.location.hash = "gestion";
window.location.hash = "Again-gestion"; // again because google chrome don't insert first hash into history
window.onhashchange = function() {
    window.location.hash = "gestion";
};

/* Vars */
$body = $('body');
$loading = $('#loading-spinner');
$modal = $('#util-modal-lg');
$modal_sm = $('#util-modal-sm');
$modal_xl = $('#util-modal-xl');
$modal_st = $('#util-modal-st');
$main_content = $('#main_content');
$loadingCount = 0;

/* Modals */
$modal.on('hidden.bs.modal', function() {
    $('.modal-dialog', $modal).empty();
});

$modal_sm.on('hidden.bs.modal', function() {
    $('.modal-dialog', $modal_sm).empty();
});

$modal_xl.on('hidden.bs.modal', function() {
    $('.modal-dialog', $modal_xl).empty();
});

$modal_st.on('hidden.bs.modal', function() {
    $('.modal-dialog', $modal_st).empty();
});

/* Logout */
$body.on('click', '.logout', function(e) {
    e.preventDefault();
    $('#logout-form').submit();
});

/* Loading */
function showLoading() {
    $loading.show();
    NProgress.start();
    $loadingCount++;
}

function hideLoading() {
    if($loadingCount == 0){
        $loading.hide();
        NProgress.done();
    } else if ($loadingCount > 0){
        $loadingCount--;
        if($loadingCount == 0){
            $loading.hide();
            NProgress.done();
        }
    } else {
        $loading.hide();
        NProgress.done();
    }
}

/* Ajaxify */
function pushRequest(url, target, callback, method, data, scrollTop = true, options = null) {

    let config = {
        type: method || 'get',
        data: data || {},
        beforeSend: function () {
            $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
            showLoading();
        }
    };

    if (options && options.file === true) {
        config.processData = false;
        config.contentType = false;
        config.enctype = 'multipart/form-data';
    } else if (options && options.form === true) {
        config.processData = false;
        config.contentType = false;
    }

    $.ajax(url, config).done(function (response) {
        processResponse(response, target, callback);
        $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
    }).fail(function (request, error) {
        notify('An error occurred while trying to complete the transaction.', 'error', 'Error!');
        console.error(error);
    }).always(function () {
        if (scrollTop) {
            $('html, body').animate({scrollTop: 0}, 500);
        }
        hideLoading();
        $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
    });
}

function processResponse(response, target, callback) {

    if (response.no_auth)
        window.location = '/login';

    if (response.view) {
        target = target || '#main_content';
        let $target = $(target);
        $target.empty().html(response.view);
        init_switchery($target);
        init_icheck($target);
        init_tooltip();
    }

    else if (response.modal) {
        let $target_md = $modal.find('.modal-dialog');
        $target_md.html(response.modal);
        init_switchery($target_md);
        init_icheck($target_md);
        init_tooltip();
        $modal.modal('show');
    }

    else if (response.modal_sm) {
        let $target_sm = $modal_sm.find('.modal-dialog');
        $target_sm.html(response.modal_sm);
        init_switchery($target_sm);
        init_icheck($target_sm);
        init_tooltip();
        $modal_sm.modal('show');
    }

    else if (response.modal_xl) {
        let $target_xl = $modal_xl.find('.modal-dialog');
        $target_xl.html(response.modal_xl);
        init_switchery($target_xl);
        init_icheck($target_xl);
        init_tooltip();
        $modal_xl.modal('show');
    }

    else if (response.modal_st) {
        let $target_st = $modal_st.find('.modal-dialog');
        $target_st.html(response.modal_st);
        init_switchery($target_st);
        init_icheck($target_st);
        init_tooltip();
        $modal_st.modal('show');
    }

    if (response.message) {
        let message = response.message;
        notify(message.text, message.type, message.title);
    }

    if (response.exception) {
        let exception = response.exception;
        notify(exception.message, 'error', 'Error!');
        console.log(exception);
    }


    typeof callback === 'function' && callback(response);
    typeof setContentHeight === 'function' && setContentHeight();
}

$('.main_container').on('click', '.ajaxify', function(e) {
    e.preventDefault();

    let url = $(this).attr('href') || $(this).attr('data-href');
    if (!url)
        return;

    let target = $(this).attr('data-ajaxify') || '#main_content';

    pushRequest(url, target);
});

/* Form validation methods */

let onlyNumbersRegex = new RegExp('^\\d+$');
let alphanumericRegex = new RegExp('^[a-zA-Z0-9]*$');

$.validator.addMethod("onlyIntegers", function(value, element) {
    if(value !== ''){
        return onlyNumbersRegex.test(value);
    } else
        return true;
}, 'Por favor, ingrese solamente números enteros');

$.validator.addMethod('lettersOnly', function(value, element) {
    if(value !== ''){
        return this.optional(element) || /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/i.test(value);
    } else
        return true;
}, 'Por favor, ingrese solamente letras');

$.validator.addMethod('emailChecker', function(value) {
    if(value !== ''){
        const email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
        return email.test(value);
    } else
        return true;
}, 'Por favor, ingrese una dirección de correo válida');

$.validator.addMethod("passport", function(value) {
    if(value !== ''){
        return alphanumericRegex.test(value);
    } else
        return true;
}, 'Por favor, ingrese un pasaporte válido');

$.validator.addMethod('cedula', function(value) {
    if(value !== ''){

        let provinceCode = value.substring(0, 2);
        if ((provinceCode >= 1 && provinceCode <= 24) || provinceCode === 30) {

            let [sum, mul, index] = [0, 1, value.length];
            while (index--) {
                let num = value[index] * mul;
                sum += num - (num > 9) * 9;
                mul = 1 << index % 2;
            }
            return (sum % 10 === 0) && (sum > 0) && value.length === 10;
        } else {
            return false;
        }

    } else {
        return true;
    }
}, 'Por favor, ingrese una cédula válida');

$.validator.addMethod("ruc", function(value) {
    if(value !== ''){
        return onlyNumbersRegex.test(value) && value.length === 13;
    } else
        return true;
}, 'Por favor, ingrese un RUC válido');

/* Form */
$validateDefaults = {
    ignore: [],
    rules: {},
    messages: {},

    highlight: function(element, errorClass, validClass) {
        $(element).addClass(errorClass).removeClass(validClass);
        if ($(element.form).find("label[for='" + element.id + "']").length)
            $(element.form).find("label[for='" + element.id + "']")
                .addClass(errorClass);
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass(errorClass).addClass(validClass);
        if ($(element.form).find("label[for='" + element.id + "']").length)
            $(element.form).find("label[for='" + element.id + "']")
                .removeClass(errorClass);
    },

    errorElement: 'span',
    errorClass: 'help-block',

    errorPlacement: function(error, element) {
        if (element.hasClass('select2-hidden-accessible'))
            error.insertAfter(element.next('span'));
        else {
            if (element.parent('.input-group').length)
                error.insertAfter(element.parent());
            else
                error.insertAfter(element);
        }

    }
};

$formAjaxDefaults = {
    dataType: 'json',

    beforeSubmit: function(formData, jqForm) {

        if (jqForm.valid()) {

            showLoading();
            return true;
        }

        return false;
    },

    success: function(response) {
        processResponse(response, '#main_content', function() {
            $validateDefaults.rules = {};
            $validateDefaults.messages = {};
        });
    },

    error: function(param1, param2, param3) {
        notify('Ha ocurrido un error al intentar realizar la transacci&#243;n', 'error', 'Error!');
        $validateDefaults.rules = {};
        $validateDefaults.messages = {};
        console.log(param3);
    },

    complete: function() {
        hideLoading();
    }
};

// Clean form validations
function cleanFormValidations(formId)
{
    $('.has-error', $('#'+formId)).removeClass('has-error');
    $('.has-success', $('#'+formId)).removeClass('has-success');
    $('.help-block', $('#'+formId)).remove();
}

/* Password */
$('#change-passwd-top').on('click', function() {
    $('.modal-dialog', $modal).load('/profile/password', function() {
        $modal.modal('show');
    });
});

$('#change-passwd-left').on('click', function() {
    $('.modal-dialog', $modal).load('/profile/password', function() {
        $modal.modal('show');
    });
});

function checkNoPassword() {
    let $noPassword = $('.no-passwd', $modal);
    if ($noPassword) {
        $noPassword.load('/profile/password', function() {
            $modal.attr('data-backdrop', 'static');
            $modal.attr('data-keyboard', 'false');
            $modal.modal('show');
        });
    }
}

/* On Ready */
$(document).ready(function() {
    $('.ajaxify.start').click();

    checkNoPassword();
});

/* Bootbox Modal */

function confirmModal(message, callback, callback_cancel = null) {

    bootbox.confirm({
        title: '<i class="fa fa-exclamation-circle"></i> Confirmación',
        backdrop: true,
        className: 'bootbox-modal',
        closeButton: false,
        buttons: {
            confirm: {
                label: 'Aceptar',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-danger'
            }
        },
        message: message,
        callback: function(result) {
            if (result) {
                typeof callback === 'function' && callback();
            } else {
                typeof callback_cancel === 'function' && callback_cancel();
            }
        }
    })
}

function messageModal(message, callback) {

    bootbox.alert({
        title: '<i class="fa fa-exclamation-circle"></i> Mensaje',
        backdrop: true,
        className: 'bootbox-modal',
        closeButton: false,
        buttons: {
            ok: {
                label: 'Aceptar',
                className: 'btn-success'
            }
        },
        message: message,
        callback: function(result) {
            if (result) {
                callback();
            }
        }
    })
}

(function(global) {

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    let _hash = "!";
    let noBackPlease = function() {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function() {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function() {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function() {
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function(e) {
            let elm = e.target.nodeName.toLowerCase();
            if (e.key === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };
    }

})(window);