<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script type="text/javascript">

        // Set default CSRF header
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Intercept login form
        $('#login-form').submit(function(e){
            // Prevent normal form submission, we well do in JS instead
            e.preventDefault();
            // Get form data
            var data = {
                email: $('[name=email]').val(),
                password: $('[name=password]').val(),
                remember: $('[name=remember]').val(),
            };
            // Send the request
            $.post($('this').attr('action'), data, function(response) {
                if (response.success) {
                    // If login success, redirect
                    window.location.replace(response.redirect);
                }
            }).catch(error =>{
                    console.log(error.responseJSON.errors);
                    var ereur = error.responseJSON.errors.email[0] ;
                    document.getElementById('error-login').textContent = ereur;
                })
        });
        // Intercept register form
        $('#register-form').submit(function(e){

            // Prevent normal form submission, we well do in JS instead
            e.preventDefault();
            // Get form data
            var data = {
                name: $('[name=name]').val(),
                email: $('[name=email]').val(),
                password: $('[name=password]').val(),
                password_confirmation: $('[name=password_confirmation]').val(),
            };
            // Send the request
            $.post($('this').attr('action'), data, function(response) {
                if (response.success) {
                    // If register success, redirect
                    window.location.replace(response.redirect);
                }
            }).catch(error =>{
                console.log(error.responseJSON.errors);
                var errormail = error.responseJSON.errors.email[0];
                var errorpassword = error.responseJSON.errors.password[0];
                document.getElementById('error-mail').textContent = errormail;
                document.getElementById('error-password').textContent = errorpassword;
            })
        });
    </script>
    @yield('js')

</body>
</html>
