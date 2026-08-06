<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> {{ $thisUser->companyInfo['company_description'] }} </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('components/bower_components/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('components/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('components/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('components/dist/css/AdminLTE.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('components/plugins/iCheck/square/blue.css') }}">
        
        <link rel="stylesheet" href="{{ asset('components/dist/css/skins/_all-skins.min.css') }}">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <style type="text/css">
        .user 
        {
            float: left;
            text-shadow: 1px 1px 3px #00c0ef;
        }

        .head-title
        {
            margin-top: 25px;
            padding: 10px;
            text-align: center;
            /*background-image: linear-gradient(#A3A3A3, #d2d6de);*/
        }
        .main-module-footer
        {
            background-color: #FFF;
            padding: 15px;
        }
        .module-title
        {
            margin-bottom: 25px;
            border-bottom: 1px solid #999;
        }
    </style>

    <body class="hold-transition login-page skin-blue sidebar-mini">
        
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><b>AD</b></span>
                <span class="logo-lg"><b>ADMINISTRATOR</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ asset($thisUser->profile_path) }}" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset($thisUser->profile_path) }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ $thisUser->firstname }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{ asset($thisUser->profile_path) }}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ $thisUser->position_title }}
                                        <small>Member since {{ date('m-d-Y', strtotime($thisUser->created_at)) }}</small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="/welcome" class="btn btn-flat btn-default"> <i class="fa fa-log-out"></i> Change Module </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('settings.route',['path' => 'users', 'action' => 'settings-view-users-profile', 'id' => Crypt::encrypt($thisUser->users_id)])}}" class="btn btn-default btn-flat"> Profile </a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li class="hide">
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="container" style="height: 93vh;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="head-title">
                            <a href="" target="_blank" style="color: #367fa9; text-shadow: 1px 1px 3px #00c0ef; opacity: 1; font-size: 16px; font-weight: 100; font-family: arial; width: 100%">
                                <div style="width: 100%; padding: 0px 0px 0px 0px;">
                                    {{ $thisUser->companyInfo['company_name'] }}
                                    <hr style="border-color: #00c0ef; margin-top: 5px; margin-bottom: 5px;">
                                    <b style="font-size: 20px;">
                                    {{ $thisUser->companyInfo['company_description'] }}
                                    </b><br>
                                    {{ $thisUser->companyInfo['company_tagline'] }} <br>
                                    {{ $thisUser->companyInfo['company_location'] }}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="module-title clearfix"> 
                        <h1 style="color: #367fa9; font-size: 25px; font-weight: 600; font-family: arial; width: 100%">
                            <div class="user"> {{ $thisUser->firstname }} {{ $thisUser->lastname }} </div> &nbsp;
                        </h1>
                    </div>
                    <div class="box-tools">
                        <div class="form-group">
                            <select class="form-control" id="select_company">
                            @foreach($usersCompany as $key => $value)
                            <option value="{{ $value->company_id }}" {{ ($value->company_id == $thisUser->company_id) ? 'selected' : ''}}> {{ strtoupper($value->company_code) }} - {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUser->company_id) ? ' (ACTIVE COMPANY)' : ''}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    @include('errors.alerts')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <?php 

                            if(count($usersModule) == 1){
                                $colSize = 'col-xs-12 col-sm-6 col-md-6 col-lg-12';
                            }
                            else if(count($usersModule) == 2)
                            {
                                $colSize = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
                            }
                            else if(count($usersModule) == 3)
                            {
                                $colSize = 'col-xs-12 col-sm-6 col-md-6 col-lg-4';
                            }
                            else
                            {
                                $colSize = 'col-xs-12 col-sm-6 col-md-6 col-lg-3';
                            }

                        ?>
                        @foreach($usersModule as $key => $value)
                            <div class="{{ $colSize }}">
                                <div class="small-box {{ $value->module_class }}">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p> Active User </p>
                                    </div>
                                    <div class="icon">
                                        <i class="{{ $value->module_icon }}"></i>
                                    </div>
                                    <a href="{{ $value->module_prefix }}/{{ $value->module_route }}" class="small-box-footer" style="padding: 10px; cursor: pointer;">
                                        <label style="cursor: pointer;"> {{ $value->module_description }} </label>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-module-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b> Version </b> {{ config('app.probuilder.version') }}
                </div>
                <strong>Copyright &copy; {{ (date('Y') == config('app.probuilder.since')) ? '' : config('app.probuilder.since').'-' }}{{ date('Y') }} 
                 - All rights reserved. </strong>
            </div>
        </footer>
        
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="{{ asset('components/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('components/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('components/plugins/iCheck/icheck.min.js') }}"></script>

        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
                $('#select_company').on('change',function(){
                    $.ajax({
                        url: '{{ route('update.users.company') }}',
                        dataType: 'json',
                        data: {'company_id' : $(this).val()},
                        type: 'post',
                        success: function (){
                            window.location.reload();
                        }
                    })
                });
            });
        </script>

    </body>
</html>