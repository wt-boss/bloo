<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>


    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" ></script>
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
    <?php echo $__env->yieldContent('js'); ?>

</body>
</html>
<?php /**PATH C:\Users\kirra belloche\Desktop\bloo\Bloo\resources\views/layouts/app.blade.php ENDPATH**/ ?>