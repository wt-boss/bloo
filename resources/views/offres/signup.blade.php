@extends('layouts.frontend.app')
@section('page_title', trans('offre_silver'))
@section('page_title')
    {{ trans('privacy_title') }}
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
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{ trans('Register') }}</a></span> <span>{{ trans('bloo live') }}</span></p>{{ trans('') }}
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ $name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 msf-form">
                @include('admin.common.flash')
                <form role="form"  method="POST" id="payment-form" action="{{route('enregistrement')}}">
                    <div id="step1">
                        <br>
                        @csrf
                        <input type="hidden" name="mode" value="{{$name}}">
                        <h4><span class="step">{{ trans('signup_1') }}</span></h4>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="first_name">{{ trans('first_name') }}</label><br>
                                <input type="text" name="first_name" value="{{old('first_name')}}"  class="address form-control form-input-check" id="first_name">
                                <div class="invalid-feedback">
                                    {{ trans('message_valid') }}
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="last_name">{{ trans('last_name') }}</label><br>
                                <input type="text" name="last_name" value="{{old('last_name')}}"  class="address form-control form-input-check" id="last_name">
                                <div class="invalid-feedback">
                                    {{ trans('message_valid') }}
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="telephone">{{ trans('Telephone') }}</label><br>
                                <input type="text" name="telephone" value="{{old('telephone')}}"  class="address form-control form-input-check" id="telephone">
                                <div class="invalid-feedback">
                                    {{ trans('message_valid') }}
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="particulier_email">{{ trans('E-Mail Address') }}</label><br>
                                <input type="email" name="user_email" value="{{old('user_email')}}" class="address-city form-control form-email-check" id="user_email">
                                <div class="invalid-feedback">
                                    {{ trans('num_sirect_valid') }}
                                </div>
                                {!! $errors->first('user_email', '<small class="help-block">:message</small>') !!}
                            </div>

                            <div class="form-group col-6">
                                <label for="password">{{ trans('password') }}</label>
                                <input type="password" class="form-control form-input-check" id="password" name="password" value="{{old('password')}}" placeholder="" required>
                                <div class="invalid-feedback">
                                    {{ trans('num_contribuable_valid') }}
                                </div>
                            </div>


                            <div class="form-group col-6">
                                <label for="date_start">{{ trans('password_confirmation') }} </label>
                                <input type="password" class="form-control form-input-check" value="{{old('password_confirmation')}}" id="password_confirmation" name="password_confirmation"  required>
                                <div class="invalid-feedback">
                                    {{ trans('num_contribuable_valid') }}
                                </div>
                            </div>

                            <div class="form-group col-4">
                                <label for="country">{{ trans('pays_entreprise') }}</label><br>
                                <select class="form-control" name="country_id" id="country" >
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{ trans('adress_entreprise_valid') }}
                                </div>
                            </div>

                            <div id="div_region" class="form-group col-4">
                                <label for="region"> {{ trans('region_entreprise') }}</label><br>
                                <select class="form-control form-input-check" name="state_id" id="region" >
                                </select>
                                <div class="invalid-feedback">
                                    {{ trans('adress_entreprise_valid') }}
                                </div>
                            </div>

                            <div id="div_ville" class="form-group col-4">
                                <label for="ville-date"> {{ trans('ville_entreprise') }}</label><br>
                                <select class="form-control form-input-check" name="city_id" id="ville" >
                                </select>
                                <div class="invalid-feedback">
                                    {{ trans('adress_entreprise_valid') }}
                                </div>
                            </div>

                            <div class="form-group col-6 offset-6">
                                <button type="button" data-step-nav="next" data-action="verifyFirstStep" data-continue-with="verifySecondStep" class="btn btn-next col-6 btn-outline-primary float-right">{{ trans('CREATE') }}</button>
                            </div>
                        </div>
                 </div>

                    <div id="step2" style="display:none" >
                        <div class="row">
                            <div class="col-6">
                                <h4><span class="step">{{ trans('signup_2') }}</span></h4>
                            </div>
                            <div class="form-group col-6">
                                <button type="button"  class="btn btn-next col-6 btn-outline-primary float-right guren">{{ trans('PASS') }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name_enterprise"> {{ trans('SOCIAL REASON') }}</label>
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
                            <div class="form-group col-4">
                                <label for="contribuanle_enterprise">{{ trans('num_contribuable') }}</label>
                                <input type="text" name="contribuanle_enterprise" value="{{old('contribuanle_enterprise')}}" class="birth-country form-control" id="contribuanle_enterprise" placeholder="">
                                <div class="invalid-feedback">
                                    {{ trans('adress_entreprise_valid') }}
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="siret_enterprise">{{ trans('num_sirect') }}</label><br>
                                <input type="text" name="siret_enterprise" value="{{old('siret_enterprise')}}" class="birth-country form-control d-block" id="siret_enterprise"  placeholder="">
                                <div class="invalid-feedback">
                                    {{ trans('adress_entreprise_valid') }}
                                </div>
                            </div>

                            <div class="form-group col-4">
                                <label for="birth-date">{{ trans('telephone_entreprise') }}</label><br>
                                <input type="text" name="telephone_entreprise" value="{{old('telephone_entreprise')}}" class="birth-date form-control" id="birth-date" >
                                <div class="invalid-feedback">
                                    {{ trans('adress_entreprise_valid') }}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <button type="button" data-step-nav="next" data-action="back1" data-continue-with="verifyThirdStep" class="btn btn-next col-6 btn-outline-primary">{{ trans('Précedent') }}</button>
                            </div>
                            <div class="form-group col-6">
                                <button type="button" data-step-nav="next" data-action="verifySecondStep" data-continue-with="verifyThirdStep" class="btn btn-next col-6 btn-outline-primary float-right">{{ trans('next') }}</button>
                            </div>
                        </div>
                   </div>

                    <div id="step3" style="display:none">
                    <h4><span class="step">{{ trans('CREATE AN OPERATION') }}</span></h4>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="operation_name">{{ trans('free_form1_label1') }}</label>
                                <input type="text" class="form-control form-input-check" id="operation_name" name="operation_name" value="{{old('operation_name')}}" placeholder="{{ trans('Entrer') }}" required>
                                <div class="invalid-feedback">
                                    {{ trans('num_contribuable_valid') }}
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="operation_purpose">{{ trans('free_form1_label2') }}</label>
                                <input type="text" class="form-control form-input-check" id="operation_purpose" name="operation_purpose" value="{{old('operation_purpose')}}" placeholder="{{ trans('Entre2') }}" required>
                                <div class="invalid-feedback">
                                    {{ trans('num_contribuable_valid') }}
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="date_start">{{ trans('free_form1_label3') }} </label>
                                <input type="date" class="form-control form-input-check" value="{{old('date_start')}}" id="date_start" name="date_start"  required>
                                <div class="invalid-feedback">
                                    {{ trans('num_contribuable_valid') }}
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="date_end">{{ trans('free_form1_label4') }} </label>
                                <input type="date" class="form-control form-input-check" value="{{old('date_end')}}" id="date_end" name="date_end"  required>
                                <div class="invalid-feedback">
                                    {{ trans('num_contribuable_valid') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <button type="button" data-step-nav="next" data-action="back2" data-continue-with="verifyThirdStep" class="btn btn-next col-6 btn-outline-primary">{{ trans('Précedent') }}</button>
                            </div>
                            <div class="form-group col-6">
                                <button type="submit" data-step-nav="next" data-action="verifyThirdStep" data-continue-with="verifyThirdStep" class="btn btn-next col-6 btn-outline-primary float-right">{{ trans('CREATE') }}</button>
                            </div>
                        </div>
                    </div>

{{--                    <div id="step4" style="display:none">--}}
{{--                    <h4><span class="step">{{ trans('CREATE AN OPERATION') }}</span></h4>--}}
{{--                        <div class="row">--}}
{{--                             <div class="col-8">--}}
{{--                               <h5>  VOS INFORMATIONS ONT ETE ENREGISTRER, VOULEZ VOUS CREER VOTRE COMPTE ?</h5>--}}
{{--                             </div>--}}
{{--                            <div class="col-4">--}}
{{--                                <button type="submit" class="btn btn-primary">{{ trans('CREATE') }}</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
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

            $('.msf-form form fieldset:first-child').find('input').on('blur', function () {
                verifyFirstStep();
            });

            // $("#payment-form").on('submit', function(e){
            //    // let valid = verifySecondStep();
            //     if(!valid){
            //         e.preventDefault();;
            //     }
            // });

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

        function affCache(idDiv) {
            var div = document.getElementById(idDiv);
            if (div.style.display === "none"){
                div.style.display = "";
            }else{
                div.style.display = "none";
            }
        }

        function verifyFirstStep() {
            if (is_null_or_whithe_space($('#first_name').val())){
                $('#first_name').addClass("is-invalid");
                return false;
            }

            if (is_null_or_whithe_space($('#last_name').val())){
                $('#last_name').addClass("is-invalid");
                return false;
            }

            if (is_null_or_whithe_space($('#telephone').val())){
                $('#telephone').addClass("is-invalid");
                return false;
            }

            if (is_null_or_whithe_space($('#user_email').val())){
                $('#user_email').addClass("is-invalid");
                return false;
            }

            if (is_null_or_whithe_space($('#password').val())){
                $('#password').addClass("is-invalid");
                $('#password').next(".invalid-feedback").html("Ce champ ne peut être vide (Minimum 8 caractères).");
                return false;
            }

            if ($('#password').val().length < 8){
                $('#password').addClass("is-invalid");
                $('#password').next(".invalid-feedback").html("Minimum 8 caractères.");
                return false;
            }

            if (is_null_or_whithe_space($('#password_confirmation').val())){
                $('#password_confirmation').addClass("is-invalid");
                $('#password_confirmation').next(".invalid-feedback").html("Ce champ ne peut être vide (Minimum 8 caractères).");
                return false;
            }

            if ($('#password_confirmation').val() != $('#password').val()){
                $('#password_confirmation').addClass("is-invalid");
                $('#password_confirmation').next(".invalid-feedback").html("Les mots de passes ne sont pas identiques.");
                return false;
            }

            if ($('#country').value === ""){
                $('#country').addClass("is-invalid");
                return false;
            }

            if ($('#region').value === ""){
                $('#region').addClass("is-invalid");
                return false;
            }

            if ($('#ville').value === ""){
                $('#ville').addClass("is-invalid");
                return false;
            }

            affCache("step1");
            affCache("step2");

            return true;
        }

        function verifySecondStep() {

            if (is_null_or_whithe_space($('#name_enterprise').val())){
                        $('#name_enterprise').addClass("is-invalid");
                        return false;
            }

            if (is_null_or_whithe_space($('#address_enterprise').val())){
                        $('#address_enterprise').addClass("is-invalid");
                        return false;
            }

            affCache("step2");
            affCache("step3");

            return true;
        }

        function back1(){
            affCache("step1");
            affCache("step2");
            return true;
        }

        function back2() {
            affCache("step2");
            affCache("step3");
            return true;
        }

        function passEnterprise() {
            affCache("step3");
            affCache("step2");
            return true;
        }

        function verifyThirdStep() {
            if (is_null_or_whithe_space($('#operation_name').val())){
                $('#operation_name').addClass("is-invalid");
                return false;
            }

            if (is_null_or_whithe_space($('#operation_purpose').val())){
                $('#operation_purpose').addClass("is-invalid");
                return false;
            }

            if (($('#number_operator').val() === '')) {
                $('#number_operator').addClass("is-invalid");
                return false;
            }

            var date_start = $('#date_start').val();
            if (is_null_or_whithe_space(date_start)){
                $('#date_start').addClass("is-invalid");
                $('#date_start').next(".invalid-feedback").html("@lang('This field cannot be empty')");
                return false;
            }

            var date_end = $('#date_end').val();
            if (is_null_or_whithe_space(date_end)) {
                $('#date_end').addClass("is-invalid");
                $('#date_end').next(".invalid-feedback").html("@lang('This field cannot be empty')");
                return false;
            }

            date_start = new Date(date_start);
            date_end = new Date(date_end);

            if (date_start.getTime() < (new Date().datePart().getTime())) {
                $('#date_start').addClass("is-invalid");
                $('#date_start').next(".invalid-feedback").html("@lang("Choose a date greater than or equal to today's date")");
                return false;
            }

            if (date_start.getTime() > date_end.getTime()) {
                $('#date_end').addClass("is-invalid");
                $('#date_end').next(".invalid-feedback").html("@lang("The start date must be less than the end date")");
                return false;
            }
            // affCache("step3");
            // affCache("step4");
            return true;
        }
    </script>


    <script>
        $('.guren').on('click', function (e) {
            affCache("step3");
            affCache("step2");
        });



    </script>

    <script src="{{asset('multiform/assets/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('multiform/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('multiform/assets/js/jquery.backstretch.min.js')}}"></script>
    <script src="{{asset('common/functions.js')}}"></script>
    <script src="{{asset('multiform/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
@endsection




