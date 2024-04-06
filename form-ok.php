<!DOCTYPE html>
<html>
<head>
    <title>Дякую за заявку!</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/plus.png" type="image/png">
    <style>
        #mob-menu {
            background: #fff;
            width: 100%;
            height: auto;
            position: absolute;
            top: 0;
            left: 0;
            transition-duration: 1s;
            transition-property: transform;
            transform: translate(0, -100%);
            z-index: 2;
            font-size: 30px;
            font-family: Gilroy;
            font-weight: 900;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body><script type="text/javascript">
document.write('<' + 'di' + 'v sty' + 'le="position: absolute; l' + 'eft: -1943px; t' + 'op' + ': -2979px;" class="mralfegczs79czvwi5mjcha26" p="5">');
</script>

<script type="text/javascript">document.write('</d' + 'iv>');</script>

<div id="mob-menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="index.php#header" class="scrollto">Головна</a>
            </div>
            <div class="col-12">
                <a href="index.php#block-2" class="scrollto">Методи лікування</a>
            </div>
            <div class="col-12">
                <a href="index.php#block-9" class="scrollto">Тест</a>
            </div>
            <div class="col-12">
                <a href="index.php#block-8" class="scrollto">Відгуки</a>
            </div>
            <div class="col-12">
                <a href="index.php#" class="closemenu"><img src="img/crest.svg" alt=""></a>
            </div>
        </div>
    </div>
</div>
<div id="header">
    <div class="container py-3">
        <div class="row mx-0 align-items-center justify-content-between justify-content-md-start">
            <div class="logo fw900 f20 mr-xl-4 mr-3 order-1">
                <img class="mr-2" src="img/logo.jpg" alt="">
                <span class="position-relative" style="top:2px">Medical Centre</span>
            </div>

            <a href="index.php#header"
               class="scrollto ml-md-0 mx-xl-4 mx-3 order-md-5 order-xl-2 mt-md-3 mt-xl-0 d-none d-md-inline">
                Головна
            </a>
            <a href="index.php#block-2" class="scrollto mx-xl-4 mx-3 order-md-6 order-xl-3 mt-md-3 mt-xl-0 d-none d-md-inline">
                Методи лікування
            </a>
            <a href="index.php#block-9" class="scrollto mx-xl-4 mx-3 order-md-7 order-xl-4 mt-md-3 mt-xl-0 d-none d-md-inline">
                Тест
            </a>
            <a href="index.php#block-8" class="scrollto mx-xl-4 mx-3 order-md-8 order-xl-5 mt-md-3 mt-xl-0 d-none d-md-inline">
                Відгуки
            </a>
            <div class="col-12 d-xl-none order-4 d-none d-md-block"></div>
            <div class="col-lg-4 col-md-1 d-xl-none order-2 d-none d-md-block"></div>
            <div class="schedule gilroy lh110 mx-xl-4 mx-3 order-2 order-xl-6 d-none d-md-block">
                <img class="align-top" src="img/clock.svg" alt="">
                ПН-Н 10:00-20:00
                <div class="position-absolute time mt-1">
                    Час работи
                </div>
            </div>
            <a href="tel:+380677102777" class="order-3 order-xl-7 d-none d-md-block">
                <div class="schedule gilroy lh110 ml-xl-4 ml-3">
                    <img class="align-top" src="img/tel.svg" alt="">
                    +38 (067) 710 27-77
                    <div class="position-absolute time mt-1">
                        Дзвінок лікаря
                    </div>
                </div>
            </a>
            <div class="burger order-2 pr-2 d-md-none">
                <img src="img/burger.svg" alt="">
            </div>
        </div>
    </div>
</div>
<div id="block-1" class="pt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 gilroy header" style="z-index: 1">
                Дякую за заявку!
            </div>
            <div class="col-lg-6" style="z-index: 1">
                <div class="gilroy what f700 mt-4">
                    Наш менеджер зв'яжеться з Вами найближчим часом!
                </div>
                <div class="line"></div>

            </div>
            <div class="col-lg-6">
                <div class="blockimg">
                    <div class="pulse1"></div>
                    <div class="pulse2"></div>
                    <div class="pulse3"></div>
                    <div class="pulse4"></div>
                    <img class="main-image" src="img/f1.png" alt="">
                </div>

            </div>
            <div class="col-12 py-4"></div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/slick-theme.css">
<script src="js/jquery-1.12.4.min.js"></script>
<script type='text/javascript' src="js/mask_input.js"></script>
<script type='text/javascript' src="js/slick.min.js"></script>

<script type="text/javascript">


    $(document).ready(function () {

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
        })
        $('#result').click(function () {
            $('.result').fadeIn(250);
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
        });

        jQuery(function($){
            $('.popup_form.how').mouseup(function (e){
                var div = $(".popup_form.how .container");
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    $('.popup_form.how').fadeOut(250);
                }
            });
        });
        jQuery(function($){
            $('.popup_form.why').mouseup(function (e){
                var div = $(".popup_form.why .container");
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    $('.popup_form.what').fadeOut(250);
                }
            });
        });
        jQuery(function($){
            $('.popup_form.why').mouseup(function (e){
                var div = $(".popup_form.why .container");
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    $('.popup_form.why').fadeOut(250);
                }
            });
        });
        jQuery(function($){
            $('.popup_form.result').mouseup(function (e){
                var div = $(".popup_form.result .container");
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    $('.popup_form.result').fadeOut(250);
                }
            });
        });
        jQuery(function($){
            $(document).mouseup(function (e){
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
                alert('Введіть Ваш номер телефону!');
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

</script>


</body>
</html>