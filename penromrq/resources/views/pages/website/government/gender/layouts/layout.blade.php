<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <title> GAD | Gender and Development </title>
    
    <link rel="icon" href="{{ asset('web/images/logo/icon.ico') }}">
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/scrolling-nav.css" rel="stylesheet">

    <style type="text/css">

        .dropdown-menu {
            margin-top: 8px;
            width: 280px;
            background-color: #4f31a3 !important;
            border: none;
            border-radius: 0px;
        }

        .dropdown-menu .dropdown-toggle::after {
            vertical-align: middle;
            border-left: 0px solid;
            border-bottom: 0px solid transparent;
            border-top: 0px solid transparent;
        }

        .dropdown-menu .dropdown .dropdown-menu {
            left: 100%;
            top: 0%;
            margin:0 20px;
            border-width: 0;
        }

        .dropdown-menu > li a:hover,
        .dropdown-menu > li.show {
            background: #007bff;
            color: #4f31a3;
        }

        .dropdown-menu > li a:visited {
            background-color: #007bff;
            color: #4f31a3;
        }

        .dropdown-menu > li.show > a{
            color: #4f31a3;
        }

        @media (min-width: 768px) {
            .dropdown-menu .dropdown .dropdown-menu {
                margin:0;
                border-width: 1px;
            }
        }

        .text-default
        {
            color: #4f31a3;
        }

        .stat-like {
            color: #999;
            font-size: 11px;
        }
        .photo-status {
            display: flex;
        }
        .photo-status-icon {
            font-size: 12px;
            color: #999;
            font-family: 
        }
        .photo-status-icon span {
            font-size: 14px;
            transition: 0.2s;
        }
        .photo-status-icon span:hover  {
            transition: 0.2s;
            font-size: 18px;
            cursor: pointer;
        }
        .card-shadow {
            transition: 0.5s;
        }
        .card-shadow:hover {
            transition: 0.3s;
            box-shadow: 0px 1px 15px 1px #999;
        }

    </style>
</head>
<body class="bg-light" id="page-top">

    @include('pages.website.gender.layouts.nav')

    @yield('content')

    <footer class="py-5" style="background-color: #4f31a3 !important;">
        <div class="container">
            <p class="m-0 text-center text-white"> Copyright &copy; PENRO 2019 </p>
        </div>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="/bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="/bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="/bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom JavaScript for this theme -->
    <script src="/bootstrap/js/scrolling-nav.js"></script>

    <script type="text/javascript">
        (function($) {
            var defaults={
                sm : 540,
                md : 720,
                lg : 960,
                xl : 1140,
                navbar_expand: 'lg'
            };
            $.fn.bootnavbar = function() {

                var screen_width = $(document).width();

                if(screen_width >= defaults.lg){
                    $(this).find('.dropdown').hover(function() {
                        $(this).addClass('show');
                        $(this).find('.dropdown-menu').first().addClass('show').addClass('animated fadeIn').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
                            $(this).removeClass('animated fadeIn');
                        });
                    }, function() {
                        $(this).removeClass('show');
                        $(this).find('.dropdown-menu').first().removeClass('show');
                    });
                }

                $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                  if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                  }
                  var $subMenu = $(this).next(".dropdown-menu");
                  $subMenu.toggleClass('show');

                  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                  });

                  return false;
                });
            };
        })(jQuery);

        $(function () {
            $('#bootnavbar').bootnavbar();
        });

    </script>

    @stack('scripts')

</body>
</html>