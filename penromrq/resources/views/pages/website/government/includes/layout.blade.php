<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> PENRO | MARINDUQUE </title>

    <link rel="icon" href="{{ asset('web/images/logo/denr.ico') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600" type="text/css">
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> --}}
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}" type="text/css"> --}}

    {{--<link rel="stylesheet" href="{{ asset('web/bootstrap/font-awesome/font-awesome/css/font-awesome.min.css') }}" type="text/css">--}}

    {{--<link rel="stylesheet" href="{{ asset('web/bootstrap/css/bootstrap.min.css') }}" type="text/css">--}}
    <link rel="stylesheet" href="{{ asset('web/bootstrap3.4/css/bootstrap.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('web/bootstrap/css/customstyle.css') }}" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

    @yield('content')

    {{--<script type="text/javascript" src="{{ asset('web/jquery/jquery.3.0.4.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('web/jquery3.7/dist/jquery.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('web/bootstrap/js2/bootstrap.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('web/bootstrap3.4/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip();

        $('.dropdown-submenu a.submenu').on('click', function(e){

            var menu = localStorage.getItem("menuid");

            if ($('#menu' + menu).is(':visible')) 
            {
                $('#menu' + menu).toggle();
            }
            
            $('#menu' + this.id).toggle();
                localStorage.setItem("menuid",  this.id);
                return false;
            });

            resizeWidth();

        });

        $(window).resize(function(){
            resizeWidth();
        });

        function resizeWidth(){
            if($(window).width() < 700)
            {
                $('#carousel-width').removeClass('container');
            }else{
                $('#carousel-width').addClass('container');
            }
        }

    </script>

    @yield('scripts')
    
    @stack('scripts')

</body>
</html>