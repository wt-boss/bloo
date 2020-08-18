<?php $r = \Route::current()->getAction() ?>
<?php $route = (isset($r['as'])) ? $r['as'] : ''; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{asset('assets/images/bloo_favicon.png')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;700&family=Rubik:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('admin/bower_components/fontawesome/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
@yield('plugin-css')
@yield('page-css')
{{-- @yield('laraform_style') --}}

<!-- Laraform Link Style -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>


    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.back.css')}}">
</head>

@php
    $body_class = $classes['body'] ?? '';
    $current_user = auth()->user();
@endphp

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-top-nav {{ $body_class }}">

<div class="wrapper" id="app">
    <header class="main-header">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ route('admin') }}" class="navbar-brand"><img class="b_logo" src="{{ asset('assets/images/bloo_logo.png') }}" /></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav" style="margin: 0 0 0 20px;">

                        @if (auth()->user()->hasRole('Superadmin|Account Manager|Opérateur|Lecteur'))
                            <li class="<?php echo (  Str::startsWith($route, 'operation.index') || Str::startsWith($route, 'operation.view') || Str::startsWith($route, 'edit')) ? "active" : '' ?>">
                                <a class="m-link" href="{{route('operation.index')}}" >
                                    <i class="fas fa-layer-group"></i>
                                    <span>Opérations</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->hasRole('Superadmin|Account Manager'))
                            <li  class="<?php echo (  Str::startsWith($route, 'admin') || Str::startsWith($route, 'operation.show') ) ? "active" : '' ?>">
                                <a class="m-link" href="{{route('admin')}}">
                                    <i class="fas fa-th-large"></i>
                                    <span>Tableau de bord</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->hasRole('Superadmin|Account Manager'))
                            <li class="<?php echo (  Str::startsWith($route, 'compte') ) ? "active" : '' ?>">
                                <a class="m-link" href="{{route('compte.index')}}" >
                                    <i class="fas fa-briefcase"></i>
                                    <span>Comptes</span>
                                </a>
                            </li>
                        @endif


                            <li class="<?php echo (  Str::startsWith($route, 'messages') ) ? "active" : '' ?>">
                                <a class="m-link" href="{{route('messages_index')}}" >
                                    {{-- <i class="nav-icon fas fa-users-cog"></i> --}}
                                    <i class="fas fa-envelope"></i>
                                    <span>Messagerie</span>
                                </a>
                            </li>


                        @if (auth()->user()->hasRole('Superadmin'))
                            <li class="<?php echo (  Str::startsWith($route, 'user') ) ? "active" : '' ?>">
                                <a class="m-link" href="{{route('users.index')}}" >
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    @if (auth()->user()->hasRole('Superadmin|Account Manager|Opérateur|Lecteur'))
                        <!-- Notifications Menu -->
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle h-notif" data-toggle="dropdown">
                                    <i class="fas fa-comment-alt"></i>
                                    <span class="label label-danger">{{auth()->user()->notifications->count()}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have {{auth()->user()->notifications->count()}} messages</li>
                                    <li>
                                        <!-- inner menu: contains the messages -->
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <!-- User Image -->
                                                        @foreach (auth()->user()->notifications as $notification)
                                                            <!-- Message title and timestamp -->
                                                                <h4>
                                                                    @php
                                                                     $user = \App\User::findOrFail($notification->data['receiver_id']);
                                                                    echo $user->first_name." ".$user->last_name;
                                                                    @endphp
                                                                    <small><i class="fa fa-clock-o"></i>{{$notification->created_at}}</small>
                                                                </h4>
                                                                <!-- The message -->
                                                                <p> {{$notification->data['message']}}</p>

                                                        @endforeach
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        </ul>
                                        <!-- /.menu -->
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- Tasks Menu -->
                            <li class="dropdown tasks-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle h-notif" data-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- Inner menu: contains the tasks -->
                                        <ul class="menu">
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <!-- Task title and progress text -->
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <!-- The progress bar -->
                                                    <div class="progress xs">
                                                        <!-- Change the css width attribute to simulate progress -->
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{auth()->user()->avatar}}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><b>{{auth()->user()->first_name}}</b> {{auth()->user()->last_name}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{auth()->user()->avatar}}" class="img-circle" alt="User Image">
                                        <p>
                                            {{auth()->user()->getFullNameAttribute()}}
                                            <small> {{ Helper::getRolename(auth()->user()->role) }}
                                            </small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <form method="post" action="{{route('logout')}}">
                                                @csrf
                                                <button class="btn btn-default btn-flat">Déconnexion</button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasRole('Free'))
                            <li class="dropdown user user-menu">
                                <a href="{{ route('forms.logout_free') }}">
                                    <span class="hidden-xs"><b>Accueil</b></span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->

            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->

    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="container">
                    <div class="content">
                        @yield('content-header')

                        @include('admin.common.flash')

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="pull-right hidden-xs">
                    <b>Powered by </b><a href="#" id="infinites">Kolors</a>
                </div>
                <ul class="col-xs-12 col-sm-10 text-center">
                    <li><a href="{{ route('Politique_de_confidentialité') }}">Confidentialité</a></li>
                    <li><a href="{{ route('Termes_&_Conditions') }}">Conditions d'utilisation</a></li>
                </ul>
            </div>
        </div>
        <!-- /.container -->
    </footer>
    @yield('admin_lte_script')
    @yield('laraform_script1')
    @yield('plugin-scripts')
    @yield('laraform_script2')
    @yield('page-script')

</div>
<!-- ./wrapper -->
</body>
</html>
