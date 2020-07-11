<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Bloo | @yield('page_title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="{{asset('assets/images/bloo_favicon.png')}}">

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;700&family=Rubik:wght@300&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
      <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mystyle.css')}}">
      @yield('css')
  </head>
  <body>
    <!-- END nav -->
    @include('layouts.frontend.partial.nav')

    @yield('content')

    @include('layouts.frontend.partial.footer')

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript">

        // Intercept login form
        $('#login-form').submit(function(e){
            // Prevent normal form submission, we well do in JS instead
            e.preventDefault();
            // Get form data
            var data = {
                "_token": $('#token').val(),
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
                console.log(error);
                console.log(data);
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
                "_token": $('#token').val(),
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
                var errormail = error.responseJSON.errors.email;
                var errorpassword = error.responseJSON.errors.password;
                document.getElementById('error-mail').textContent = errormail;
                document.getElementById('error-password').textContent = errorpassword;
            })
        });
    </script>
  <script src="{{asset('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('assets/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('assets/js/aos.js')}}"></script>
  <script src="{{asset('assets/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.js"></script>
  <script src="{{asset('assets/js/scrollax.min.js')}}"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>
    <script>
        $(document).on('click', '.delete-option', function() {
            $(this).parent(".input-field").remove();
        });
        // will replace .form-g class when referenced
        var material1 = '<div class="form-group input-field input-g">' +
            '<input name="answers[][answer]" id="nom_option[]" type="text" class="form-control"  placeholder="Entrer option">' +
            '<span class="add-option badge badge-info" style="cursor:pointer;">Ajouter une autre</span>' +
            '</div>';

        var material = '<div class="form-group input-field input-g">' +
            '<input name="answers[][answer]" id="nom_option[]" type="text" class="form-control"  placeholder="Entrer option">' +
            '<span style="float:right; cursor:pointer;"class="delete-option badge badge-danger">Supprimer</span>' +
            '<span class="add-option badge badge-info" style="cursor:pointer;">Ajouter une autre</span>' +
            '</div>';

        // for adding new option
        $(document).on('click', '.add-option', function() {
            $(".form-g").append(material);
        });
        // allow for more options if radio or checkbox is enabled
        $(document).on('change', '#question_type', function() {
            var selected_option = $('#question_type :selected').val();
            if (selected_option === "radio" || selected_option === "checkbox") {
                $(".form-g").html(material1);
            } else {
                $(".input-g").remove();
            }
        });
    </script>
    <script src="{{asset('js/dist/clipboard.js')}}"></script>
    <script src="{{asset('assets/js/myscript.js')}}"></script>
    @yield('script')
  </body>
</html>
