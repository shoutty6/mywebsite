$(document).ready(function () {
    function rubberFrame(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }

    $('.playbut').click(function () {
        $('.popup_form.video').fadeIn(250);
        $('.popup_form.video iframe').attr('src', 'https://www.youtube.com/embed/' + $(this).data('src'));
            rubberFrame($('.popup_form.video iframe').get(0));
    });
    $('.callback').click(function () {
        $('.popup_form.form').fadeIn(250);
    });
    $('.burger').click(function () {
        if ($('#mob-menu').hasClass('open')) {
            $('#mob-menu').removeClass('open')
        } else {
            $('#mob-menu').addClass('open')
        }
    });
    $('.closemenu').click(function () {
        $('#mob-menu').removeClass('open')
    });
    $('#mob-menu a').click(function () {
        $('#mob-menu').removeClass('open');
    });
    $('#result').click(function () {
        var ans = 0;
        $('.but-quiz').each(function () {
            if ($(this).hasClass('selected')) {
                $('.popup_form.result #head').html($(this).data('head'));
                $('.popup_form.result #underhead').html($(this).data('underhead'));
                $('.popup_form.result').fadeIn(250);
                ans = 1;

            }
        });
        if (ans == 0) {
            alert('Выберите ответ');
            return false;
        }
    });
    $('#how').click(function () {
        $('.how').fadeIn(250);
    });
    $('#what').click(function () {
        $('.what').fadeIn(250);
    });
    $('#why').click(function () {
        $('.why').fadeIn(250);
    });
    $('.crest').click(function () {
        $(this).parents('.popup_form').fadeOut(250);
        $('.popup_form.video iframe').attr('src', '')
    });
    jQuery(function ($) {
        $('.popup_form.video').mouseup(function (e) {
            var div = $(".popup_form.video .container");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $('.popup_form.video').fadeOut(250);
                $('.popup_form.video iframe').attr('src', '')
            }
        });
    });
    jQuery(function ($) {
        $('.popup_form.how').mouseup(function (e) {
            var div = $(".popup_form.how .container");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $('.popup_form.how').fadeOut(250);
            }
        });
    });
    jQuery(function ($) {
        $('.popup_form.what').mouseup(function (e) {
            var div = $(".popup_form.what .container");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $('.popup_form.what').fadeOut(250);
            }
        });
    });
    jQuery(function ($) {
        $('.popup_form.why').mouseup(function (e) {
            var div = $(".popup_form.why .container");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $('.popup_form.why').fadeOut(250);
            }
        });
    });
    jQuery(function ($) {
        $('.popup_form.result').mouseup(function (e) {
            var div = $(".popup_form.result .container");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $('.popup_form.result').fadeOut(250);
            }
        });
    });
    jQuery(function ($) {
        $(document).mouseup(function (e) {
            var div = $(".popup_form.form .form");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $('.popup_form.form').fadeOut(250);

            }
        });
    });

    $(".scrollto").click(function () {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
        return false;
    });


    $('.but-quiz').click(function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            $('.pain[data-index="' + $(this).data('index') + '"]').css('opacity', '0');
        } else {

            $('.but-quiz').each(function () {
                if ($(this).hasClass('selected')) {
                    $(this).click();
                }
            });
            $(this).addClass('selected');
            $('.pain[data-index="' + $(this).data('index') + '"]').css('opacity', '1');
        }
    });

    $('.slick').slick({
        dots: true,
        arrows: false
    });
    if (screen.width < 760) {
        $('.slickonmob').slick({
            dots: false,
            arrows: true
        });
    }

    $('form').submit(function (event) {
        var phon = $(this).find("input[name='phone']").val();
        if (phon.indexOf('_') == -1 && phon != null && typeof phon !== "undefined" && phon != '') {
        } else {
            alert('Введите Ваш номер телефона!');
            return false;
        }
    });

    Inputmask.extendDefinitions({

        '~': {
            validator: "[1245679]"
        }

    });
    $("input[name='name']").on("keypress", function (e) {
        return (/[A-Za-zА-Яа-яЁё\s]/.test(String.fromCharCode(e.charCode)));
    })
    $("input[name='phone']").inputmask({
        mask: "+38 (0~9) 999-99-99",
        greedy: false,
        clearIncomplete: true,
        placeholder: "_",
        rightAlign: false,
        showMaskOnHover: false,
        showMaskOnFocus: true
    });
    $("input[name='phone']").on("keydown", function (e) {

        if (e.keyCode == 37 || e.keyCode == 38 || e.keyCode == 39 || e.keyCode == 40) {
            e.preventDefault();
            return false;
        }

    });
});