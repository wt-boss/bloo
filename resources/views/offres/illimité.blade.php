<!DOCTYPE html>
<html lang="en">
<head>
    <title> BLOO </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
    <link rel="stylesheet" href="{{asset('multiform/assets/css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('multiform/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('multiform/assets/css/media-queries.css')}}">
    @yield('css')
</head>
<body>


<!-- END nav -->


@include('layouts.frontend.partial.nav')

@yield('content')

<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Offre Illimités</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 msf-form">
            <form role="form"  method="POST" id="payment-form" action="{{route('paypal')}}">
                <fieldset>
                    @csrf
                    <br>
                    <h4><span class="step"> INFORMATIONS DU CLIENT ET PAIEMENT </span></h4>
                    <br>
                    <div class="row">
                        <div class="form-group col-8 offset-1 radio-buttons-1">
                            <h6>Etes vous une entreprise ou un particulier ?</h6>
                            <label class="radio-inline">
                                <input type="radio" id="test" class="button"  name="options" value="ENTREPRISE"> Entreprise
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="options"  class="button" value="PARTICULIER"> Particulier
                            </label>
                        </div>
                    </div>
                    <div class="row" id="entreprise">
                        <div class="form-group col-6">
                            <label for="name_enterprise">Nom de l'entreprise :</label>
                            <input type="text" class="form-control"  name="name_enterprise" placeholder="Entrer le nom de l'entreprise"  id="name_enterprise" >
                        </div>
                        <div class="form-group col-6">
                            <label for="address_enterprise">Adresse de l'entreprise :</label>
                            <input type="text" name="address_enterprise" class="form-control" id="address_enterprise" placeholder="Entrer l'addresse de l'entreprise" >
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-country">Numero Contribuable de l'entreprise :</label>
                            <input type="text" name="contribuanle_enterprise" class="birth-country form-control" id="birth-country" placeholder="Entrer le numero du contribuable">
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-country">Numero SIRET/RCCM de l'entreprise :</label><br>
                            <input type="text" name="siret_enterprise" class="birth-country form-control" id="birth-country"  placeholder="Entrer le numero">
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-date">Pays de l'entreprise :</label><br>
                            <input type="text" name="pays_entreprise" class="birth-date form-control" id="birth-date" placeholder="Entrer le pays">
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-date">Ville de l'entreprise :</label><br>
                            <input type="text" name="ville_entreprise" class="birth-date form-control" id="birth-date" placeholder="Entrer la ville">
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-date">Telephone de l'entreprise :</label><br>
                            <input type="text" name="telephone_entreprise" class="birth-date form-control" id="birth-date"  placeholder="Entrer le numero">
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_name">Nom de l'utilisateur:</label><br>
                            <input type="text" name="user_name_entreprise" class="address form-control" id="particulier_name">
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_email">Addresse Email de l'utilisateur :</label><br>
                            <input type="email" name="user_email_entreprise" class="address-city form-control" id="particulier_email">
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">Mot de passe :</label><br>
                            <input type="password" name="user_password_entreprise" class="address-city form-control" id="particulier_email">
                        </div>
                    </div>

                    <div class="row" id="particulier">
                        <div class="form-group col-6">
                            <label for="particulier_name">Nom:</label><br>
                            <input type="text" name="user_name" class="address form-control" id="particulier_name">
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_email">Addresse Email :</label><br>
                            <input type="email" name="user_email" class="address-city form-control" id="particulier_email">
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">Mot de passe :</label><br>
                            <input type="password" name="user_password" class="address-city form-control" id="particulier_email">
                        </div>
                        <div class="form-group col-6">
                            <input type="hidden"  value="68918.55" name="amount" id="amount" class="address-city form-control" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">

                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-success col-6 float-right">Payer avec PayPal</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
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
<script src="{{asset('multiform/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('multiform/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('multiform/assets/js/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('multiform/assets/js/scripts.js')}}"></script>

<script>
    $(function($){
        $('.button').click(function(e){
            var value = $('input[name=options]:checked').val();
            if (value === "ENTREPRISE") {
                var entreprise =  document.getElementById('entreprise');
                entreprise.style.display = "flex";
                var particulier =  document.getElementById('particulier');
                particulier.style.display = "none";
            } else {
                var entreprise =  document.getElementById('entreprise');
                entreprise.style.display = "none";
                var particulier =  document.getElementById('particulier');
                particulier.style.display = "flex";
            }
        });
    });
</script>

</body>
</html>

