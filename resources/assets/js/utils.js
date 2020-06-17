// Jquery validator custom methods
$.validator.addMethod('IP4Checker', function(value) {
    let ip = /^(?!0)(?!.*\.$)((1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/;
    return ip.test(value);
}, 'Por favor, escribe un ip v&aacute;lido.');

$.validator.addMethod("greaterThan", function(value, element, param) {
    return parseInt(value, 10) > parseInt($(param).val(), 10);
}, 'Por favor, ingrese un n&uacute;mero v&aacute;lido');

/* Locale datepicker */
let es_locale_datepicker = {
    "format": "DD-MM-YYYY",
    "separator": "-",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "Desde",
    "toLabel": "Hasta",
    "customRangeLabel": "Personalizado",
    "daysOfWeek": [
        "Do",
        "Lu",
        "Ma",
        "Mi",
        "Ju",
        "Vi",
        "Sa"
    ],
    "monthNames": [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ],
    "firstDay": 1
};

// get a random color
function randomColor() {

    let chars = '0123456789ABCDEF';
    let color = '#';

    for (let i = 0; i < 6; i++)
        color += chars[Math.floor(Math.random() * 16)];

    return color;
}
