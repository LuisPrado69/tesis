/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){
 *     // code here
 * });
 */
(function ($, sr) {
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        let timeout;

        return function debounced() {
            let obj = this, args = arguments;

            function delayed() {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    };

    // smartresize
    jQuery.fn[sr] = function (fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'smartresize');

let CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');
$LOGO_IMG = $('#logo_image');
$LOGO_EXPANDED_PATH = 'assets/images/logo_sloncorp.jpg';
$LOGO_COLLAPSED_PATH = 'assets/images/logo_sloncorp.jpg';

// Sidebar
function init_sidebar() {
    let setContentHeight = function () {
        // reset height
        $RIGHT_COL.css('min-height', $(window).height());

        let bodyHeight = $BODY.outerHeight(),
            footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
            leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
            contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

        // normalize content
        contentHeight -= $NAV_MENU.height() + footerHeight;

        $RIGHT_COL.css('min-height', contentHeight);
    };

    $SIDEBAR_MENU.find('a').on('click', function(ev) {
        let $li = $(this).parent();
        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        }
        else
        {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }else
            {
                if ( $BODY.is( ".nav-sm" ) )
                {
                    if (!$li.parent().is('.child_menu')) {
                        $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                        $SIDEBAR_MENU.find('li ul').slideUp();
                    }
                }
            }
            $li.addClass('active');

            $('ul:first', $li).slideDown(function() {
                $('.nav-sm ul.nav.child_menu').addClass("scrolled");
            });
        }
    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function () {

        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $LOGO_IMG.attr('src', $LOGO_COLLAPSED_PATH);
        } else {
            $SIDEBAR_MENU.find('li.active ul').show();
            $LOGO_IMG.attr('src', $LOGO_EXPANDED_PATH);
        }

        $BODY.toggleClass('nav-md nav-sm');

        setContentHeight();

        $('.dataTable').each(function () {
            $(this).dataTable().fnDraw();
        });

    });

    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href === CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function () {
        setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function () {
        setContentHeight();
    });

    setContentHeight();

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel: {preventDefault: true}
        });
    }
}

// Panel toolbox
function init_toolbox() {
    $('.collapse-link').on('click', function () {
        let $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function () {
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        let $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
}

// Tooltip
function init_tooltip() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
}

/* Switchery */
function init_switchery($container) {
    let $switches = $('.js-switch', $container);
    if ($switches[0]) {
        $switches.each(function () {
            new Switchery(this, {color: '#6EC562'});
        });
    }
}

/* iCheck */
function init_icheck($container) {
    if ($("input.flat", $container)[0]) {
        $('input.flat', $container).iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    }
}

/* PNotify */
function notify(text, type, title) {

    if (!text)
        return;

    type = type || 'info';
    title = title || 'Atenci&#243;n';

    let delay;

    let textLength = text.length;

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

//hover and retain popover when on popover content
let originalLeave = $.fn.popover.Constructor.prototype.leave;
$.fn.popover.Constructor.prototype.leave = function (obj) {
    let self = obj instanceof this.constructor ?
        obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type);
    let container, timeout;

    originalLeave.call(this, obj);

    if (obj.currentTarget) {
        container = $(obj.currentTarget).siblings('.popover');
        timeout = self.timeout;
        container.one('mouseenter', function() {
            //We entered the actual popover – call off the dogs
            clearTimeout(timeout);
            //Let's monitor popover content instead
            container.one('mouseleave', function() {
                $.fn.popover.Constructor.prototype.leave.call(self, self);
            });
        });
    }
};

/* ... */
$(document).ready(function() {
    init_sidebar();
    init_toolbox();
    init_tooltip();
});