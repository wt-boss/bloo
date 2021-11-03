@extends('layouts.frontend.app')
@section('page_title')
    {{ trans('offre_platinum') }}
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('multiform/assets/css/form-elements.css')}}">
<link rel="stylesheet" href="{{asset('multiform/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('multiform/assets/css/media-queries.css')}}">
@endsection

@section('content')
<div class="hero-wrap other-p">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><span class="mr-2"><a href="{{ route('home') }}">{{ trans('Register') }}</a></span> <span>{{ trans('bloo live') }}</span></p>{{ trans('') }}
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('offre_platinum') }}</h1>
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
                    <h4><span class="step"> {{ trans('infoclient') }} </span></h4>
                    <br>
                    <div class="row">
                        <div class="form-group col-8 offset-1 radio-buttons-1">
                            <h6>{{ trans('choise_entreprise') }}</h6>
                            <label class="radio-inline">
                                <input type="radio" id="test" class="button"  name="options" value="ENTREPRISE"> {{ trans('enterprise') }}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="options"  class="button" value="PARTICULIER"> {{ trans('Particulier') }}
                            </label>
                        </div>
                    </div>
                    <div class="row" id="entreprise">
                        <div class="form-group col-6">
                            <label for="name_enterprise">{{ trans('Nom_entreprise') }}</label>
                            <input type="text" class="form-control form-input-check"  name="name_enterprise" value="{{old('name_enterprise')}}" placeholder=""  id="name_enterprise" >
                            <div class="invalid-feedback">
                               {{ trans('chanp_valide') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="address_enterprise">{{ trans('adress_entreprise') }}</label>
                            <input type="text" name="address_enterprise" value="{{old('address_enterprise')}}" class="form-control" id="address_enterprise" placeholder="" >
                            <div class="invalid-feedback">
                                {{ trans('adress_entreprise_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-country">{{ trans('num_contribuable')}}</label>
                            <input type="text" name="contribuanle_enterprise" value="{{old('contribuanle_enterprise')}}" class="birth-country form-control" id="birth-country" placeholder="">
                            <div class="invalid-feedback">
                                {{ trans('num_contribuable_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-country">{{ trans('num_sirect') }}</label><br>
                            <input type="text" name="siret_enterprise" value="{{old('siret_enterprise')}}" class="birth-country form-control" id="birth-country"  placeholder="">
                            <div class="invalid-feedback">
                               {{ trans('adress_entreprise_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="birth-date">{{ trans('pays_entreprise') }}</label><br>
                            <select class="birth-date form-control" name="" id="country" required>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                               {{ trans('adress_entreprise_valid') }}
                            </div>
                        </div>
                        <div id="div_region" class="form-group col-6">
                            <label for="birth-date">{{ trans('region_entreprise') }}</label><br>
                            <select class="form-control form-input-check" name="" id="region" required>
                            </select>
                            <div class="invalid-feedback">
                               {{ trans('adress_entreprise_valid') }}.
                            </div>
                        </div>
                        <div id="div_ville" class="form-group col-6">
                            <label for="birth-date">{{ trans('ville_entreprise') }}</label><br>
                            <select class="form-control form-input-check" name="city_id" id="ville" required>
                            </select>
                            <div class="invalid-feedback">
                              {{ trans('num_sirect_valid') }}
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="birth-date">{{ trans('telephone_entreprise') }}</label><br>
                            <input type="text" name="telephone_entreprise" value="{{old('telephone_entreprise')}}" class="birth-date form-control" id="birth-date"  placeholder="">
                            <div class="invalid-feedback">
                                {{ trans('num_sirect_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_name">{{ trans('name_user') }}</label><br>
                            <input type="text" name="user_name_entreprise" value="{{old('user_name_entreprise')}}" class="address form-control form-input-check" id="particulier_name">
                            <div class="invalid-feedback">
                                {{ trans('message_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_email">{{ trans('adress_entreprise1') }}</label><br>
                            <input type="email" name="email_entreprise" class="address-city form-control form-email-check-perm" id="particulier_email">
                            <div class="invalid-feedback">
                                {{ trans('num_sirect_valid') }}
                            </div>
                            {!! $errors->first('email_entreprise', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_email">{{ trans('adress_user') }}</label><br>
                            <input type="email" name="user_email_entreprise" class="address-city form-control form-email-check" id="particulier_email">
                            <div class="invalid-feedback">
                              {{ trans('num_sirect_valid') }}
                            </div>
                            {!! $errors->first('user_email_entreprise', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">{{ trans('pass_word') }}</label><br>
                            <input type="password" name="user_password_entreprise" class="address-city form-control form-input-check" id="particulier_email">
                            <div class="invalid-feedback">
                               {{ trans('num_sirect_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">{{ trans('confim_pass_word') }}</label><br>
                            <input type="password" name="user_conf_password_entreprise" class="address-city form-control form-input-check" id="particulier_email">
                            <div class="invalid-feedback">
                                {{ trans('num_sirect_valid') }}
                            </div>
                        </div>
                    </div>
                    <div class="row" id="particulier">
                        <div class="form-group col-6">
                            <label for="particulier_name">{{ trans('name') }}</label><br>
                            <input type="text" name="user_name" class="address form-control form-input-check" id="particulier_name">
                            <div class="invalid-feedback">
                                {{ trans('message_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">


                            <label for="particulier_email">{{ trans('email_adress') }}</label><br>
                            <input type="email" name="user_email" class="address-city form-control form-email-check" id="particulier_email">
                            <div class="invalid-feedback">
                                {{ trans('num_sirect_valid') }}
                            </div>
                            {!! $errors->first('user_email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">{{ trans('pass_word') }}</label><br>
                            <input type="password" name="user_password" class="address-city form-control form-input-check" id="">
                            <div class="invalid-feedback">
                                {{ trans('num_sirect_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="confirm_pass">{{ trans('confim_pass_word') }}</label><br>
                            <input type="password" name="user_conf_password" class="address-city form-control form-input-check" id="">
                            <div class="invalid-feedback">
                                {{ trans('num_sirect_valid') }}
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <input type="hidden"  value="Monthly" name="offer" id="offer" class="address-city form-control" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <button type="button" data-step-nav="prev" class="btn btn-previous col-6 btn-outline-danger d-none"><i class="fa fa-angle-left"></i> {{ trans('Précedent') }}</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-success col-6 float-right">{{ trans('paye_to_paypal') }}</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('multiform/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('multiform/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('multiform/assets/js/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('common/functions.js')}}"></script>
<script src="{{asset('multiform/assets/js/scripts.js')}}"></script>
<script type="text/javascript">
    $(function($){
        // reset form onload
        $("#payment-form").trigger("reset");
        // initialisation de la localisation
        let country_id = $('#country').val();
        $.get('/json-states?country_id=' + country_id,function(data) {
            $('#region').empty();
            $.each(data, function(index, stateObj){
                $('#region').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
            });
            let state_id = $('#region').val();
            $.get('/json-cities?state_id=' + state_id,function(data) {
                $('#ville').empty();
                $.each(data, function(index, villeObj){
                    $('#ville').append('<option value="'+ villeObj.id +'">'+ villeObj.name +'</option>');
                })
            });
        });
        // changement de pays
        $('#country').change(function(e){
            let country_id = e.target.value;
            $.get('/json-states?country_id=' + country_id,function(data) {
                $('#region').empty();
                $.each(data, function(index, stateObj){
                    $('#region').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                });

                let state_id = $('#region').val();
                $.get('/json-cities?state_id=' + state_id,function(data) {
                    $('#ville').empty();
                    $.each(data, function(index, villeObj){
                        $('#ville').append('<option value="'+ villeObj.id +'">'+ villeObj.name +'</option>');
                    })
                });
            });
        });
        // changement de régions
        $('#region').on('change', function(e){
            let state_id = e.target.value;
            $.get('/json-cities?state_id=' + state_id,function(data) {
                $('#ville').empty();
                $.each(data, function(index, villeObj){
                    $('#ville').append('<option value="'+ villeObj.id +'">'+ villeObj.name +'</option>');
                })
            });
        });

        // switch entreprise - particulier
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

        $("#payment-form").on('submit', function(e){
            let valid = verifyForm();
            if(!valid){
                e.preventDefault();;
            }
        });

        //controle form on navigate
        $('.form-control').focus(function(){
            $(this).removeClass("is-invalid");
        });

        $('.form-input-check').focusout(function(){
            if (is_null_or_whithe_space($(this).val())){
                $(this).addClass("is-invalid");
            }
        });
        //controle email form on navigate
        $('.form-email-check').focusout(function(){
            if (is_null_or_whithe_space($(this).val())){
                $(this).addClass("is-invalid");
                $(this).next(".invalid-feedback").html("Ce champ ne peut être vide.");
            }else if (!is_valid_email($(this).val())){
                $(this).addClass("is-invalid");
                $(this).next(".invalid-feedback").html("Cet email n'est pas valide.");
            }
        });
        $('.form-email-check-perm').focusout(function(){
            if (is_null_or_whithe_space($(this).val())){
                // $(this).addClass("is-invalid");
            }else if (!is_valid_email($(this).val())){
                $(this).addClass("is-invalid");
                $(this).next(".invalid-feedback").html("Cet email n'est pas valide.");
            }
        });
    });

    function verifyForm() {
        const options = $('input[name=options]:checked').val();
        if (is_null_or_whithe_space(options)) return false;
        var email = '';
        switch (options) {
            case 'ENTREPRISE':
                if (is_null_or_whithe_space($('#name_enterprise').val())){
                    $('#name_enterprise').addClass("is-invalid");
                    return false;
                }

                if (is_null_or_whithe_space($('input[name="user_name_entreprise"]').val())){
                    $('input[name="user_name_entreprise"]').addClass("is-invalid");
                    return false;
                }

                email = $('input[name="user_email_entreprise"]').val();
                if (is_null_or_whithe_space(email)){
                    $('input[name="user_email_entreprise"]').addClass("is-invalid");
                    $('input[name="user_email_entreprise"]').next(".invalid-feedback").html("Ce champ ne peut être vide.");
                    return false;
                }
                if (!is_valid_email(email)){
                    $('input[name="user_email_entreprise"]').addClass("is-invalid");
                    $('input[name="user_email_entreprise"]').next(".invalid-feedback").html("Cet email n'est pas valide.");
                    return false;
                }

                if (is_null_or_whithe_space($('input[name="user_password_entreprise"]').val())){
                    $('input[name="user_password_entreprise"]').addClass("is-invalid");
                    $('input[name="user_password_entreprise"]').next(".invalid-feedback").html("Ce champ ne peut être vide (Minimum 8 caractères).");
                    return false;
                }

                if ($('input[name="user_password_entreprise"]').val().length < 8){
                    $('input[name="user_password_entreprise"]').addClass("is-invalid");
                    $('input[name="user_password_entreprise"]').next(".invalid-feedback").html("Minimum 8 caractères.");
                    return false;
                }

                if (is_null_or_whithe_space($('input[name="user_conf_password_entreprise"]').val())){
                    $('input[name="user_conf_password_entreprise"]').addClass("is-invalid");
                    $('input[name="user_conf_password_entreprise"]').next(".invalid-feedback").html("Ce champ ne peut être vide (Minimum 8 caractères).");
                    return false;
                }

                if ($('input[name="user_password_entreprise"]').val() != $('input[name="user_conf_password_entreprise"]').val()){
                    $('input[name="user_conf_password_entreprise"]').addClass("is-invalid");
                    $('input[name="user_conf_password_entreprise"]').next(".invalid-feedback").html("Les mots de passes ne sont pas identiques.");
                    return false;
                }

                break;
            case 'PARTICULIER':
                if (is_null_or_whithe_space($('input[name="user_name"]').val())){
                    $('input[name="user_name"]').addClass("is-invalid");
                    return false;
                }

                email = $('input[name="user_email"]').val();
                if (is_null_or_whithe_space(email)){
                    $('input[name="user_email"]').addClass("is-invalid");
                    $('input[name="user_email"]').next(".invalid-feedback").html("Ce champ ne peut être vide.");
                    return false;
                }
                if (!is_valid_email(email)){
                    $('input[name="user_email"]').addClass("is-invalid");
                    $('input[name="user_email"]').next(".invalid-feedback").html("Cet email n'est pas valide.");
                    return false;
                }

                if (is_null_or_whithe_space($('input[name="user_password"]').val())){
                    $('input[name="user_password"]').addClass("is-invalid");
                    $('input[name="user_password"]').next(".invalid-feedback").html("Ce champ ne peut être vide (Minimum 8 caractères).");
                    return false;
                }

                if ($('input[name="user_password"]').val().length < 8){
                    $('input[name="user_password"]').addClass("is-invalid");
                    $('input[name="user_password"]').next(".invalid-feedback").html("Minimum 8 caractères.");
                    return false;
                }

                if (is_null_or_whithe_space($('input[name="user_conf_password"]').val())){
                    $('input[name="user_conf_password"]').addClass("is-invalid");
                    $('input[name="user_conf_password"]').next(".invalid-feedback").html("Ce champ ne peut être vide (Minimum 8 caractères).");
                    return false;
                }

                if ($('input[name="user_password"]').val() != $('input[name="user_conf_password"]').val()){
                    $('input[name="user_conf_password"]').addClass("is-invalid");
                    $('input[name="user_conf_password"]').next(".invalid-feedback").html("Les mots de passes ne sont pas identiques.");
                    return false;
                }


                break;
            default:
                return false;
        }

        return true;
    }

    function affCache(idDiv) {
        var div = document.getElementById(idDiv);
        if (div.style.display === "none"){
            div.style.display = "";
        }
    }

</script>
@endsection

