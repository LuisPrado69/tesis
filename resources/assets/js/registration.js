/* PNotify */
function notify(text, type, title) {
    if (!text)
        return;

    type = type || 'info';
    title = title || 'Atenci&#243;n';

    var delay;

    var textLength = text.length;

    if(textLength >= 100)
        delay = 10000;
    else if(textLength >= 75)
        delay = 7500;
    else
        delay = 5000;

    new PNotify({
        type: type,
        title: title,
        text: text,
        delay: delay,
        nonblock: {nonblock: !0},
        styling: 'bootstrap3'

    });
}

/* Loading */
function showLoading() {
    $('#loading-spinner').removeClass('hidden');
}

function hideLoading() {
    $('#loading-spinner').addClass('hidden');
}

/* Form validation methods */
var onlyNumbersRegex = new RegExp('^\\d+$');
var alphanumericRegex = new RegExp('^[a-zA-Z0-9]*$');

$.validator.addMethod('lettersOnly', function (value, element) {
    if(value !== ''){
        return this.optional(element) || /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/i.test(value);
    } else
        return true;
}, 'Por favor, ingrese solamente letras.');

$.validator.addMethod("alphanumeric", function (value) {
    if(value !== ''){
        return alphanumericRegex.test(value);
    } else
        return true;
}, 'Por favor, ingrese solamente letras y números.');


$.validator.addMethod('emailChecker', function (value) {
    if(value !== ''){
        const email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
        return email.test(value);
    } else
        return true;
}, 'Por favor, ingrese una dirección de correo válida.');

$.validator.addMethod("passport", function (value) {
    if(value !== ''){
        return alphanumericRegex.test(value);
    } else
        return true;
}, 'Por favor, ingrese un pasaporte válido.');

$.validator.addMethod('cedula', function (value) {
    if(value !== ''){
        let [sum, mul, index] = [0, 1, value.length];
        while (index--) {
            let num = value[index] * mul;
            sum += num - (num > 9) * 9;
            mul = 1 << index % 2;
        }
        return (sum % 10 === 0) && (sum > 0) && value.length === 10;
    } else
        return true;
}, 'Por favor, ingrese una cédula válida.');

$.validator.addMethod("ruc", function (value) {
    if(value !== ''){
        return onlyNumbersRegex.test(value) && value.length === 13;
    } else
        return true;
}, 'Por favor, ingrese un RUC válido.');

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

    errorPlacement: function (error, element) {
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