@extends('layouts.frontend.app')

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
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('offre_silver') }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 msf-form">
            @include('admin.common.flash')
            <form role="form"  method="POST" id="payment-form" action="{{route('paypal')}}">
                <fieldset>
                    <br>
                    @csrf
                    <h4><span class="step">INFORMATIONS SUR L'OPERATION (ETAPE 1 / 2)</span></h4>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="operation_name">Titre :</label>
                            <input type="text" class="form-control" id="operation_name" name="operation_name" placeholder="Entrer le nom de l'operation" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="operation_purpose">Objectif :</label>
                            <input type="text" class="form-control" id="operation_purpose" name="operation_purpose" placeholder="Entrer l'objectif de l'operation" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="date_start">Date de debut : </label>
                            <input type="date" class="form-control" id="date_start" name="date_start"  required>
                        </div>
                        <div class="form-group col-6">
                            <label for="date_end">Date de fin : </label>
                            <input type="date" class="form-control" id="date_end" name="date_end"  required>
                        </div>
                        <div class="form-group col-6 offset-6">
                            <button type="button" data-step-nav="next" data-action="verifyFirstStep" data-continue-with="verifySecondStep" class="btn btn-next col-6 btn-outline-primary float-right">Suivant</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <br>
                    <h4><span class="step"> INFORMATIONS DU CLIENT ET PAIEMENT (Etape 2 / 2)</span></h4>
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
                            <select class="birth-date form-control" name="" id="country" required>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div_ville" style="display:none">
                            <div class="form-group col-6">
                                <label for="birth-date">Ville de l'entreprise :</label><br>
                                <select class="form-control" name="city_id" id="ville" required>

                                </select>
                            </div>
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
                            <label for="particulier_email">Addresse Email de l'entreprise :</label><br>
                            <input type="email" name="email_entreprise" class="address-city form-control" id="particulier_email">
                            {!! $errors->first('email_entreprise', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-6">
                            <label for="particulier_email">Addresse Email de l'utilisateur :</label><br>
                            <input type="email" name="user_email_entreprise" class="address-city form-control" id="particulier_email">
                            {!! $errors->first('user_email_entreprise', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">Mot de passe :</label><br>
                            <input type="password" name="user_password_entreprise" class="address-city form-control" id="particulier_email">
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">Confirmez mot de passe :</label><br>
                            <input type="password" name="user_conf_password_entreprise" class="address-city form-control" id="particulier_email">
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
                            {!! $errors->first('user_email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-6 ">
                            <label for="particulier_email">Mot de passe :</label><br>
                            <input type="password" name="user_password" class="address-city form-control" id="particulier_email">
                        </div>
                        <div class="form-group col-6 ">
                            <label for="confirm_pass">Confirmez mot de passe :</label><br>
                            <input type="password" name="user_conf_password" class="address-city form-control" id="particulier_email">
                        </div>
                        <div class="form-group col-6">
                            <input type="hidden"  value="3466.22" name="amount" id="amount" class="address-city form-control" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <button type="button" data-step-nav="prev" class="btn btn-previous col-6 btn-outline-danger"><i class="fa fa-angle-left"></i> Précedent</button>
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

@endsection

@section('script')
    <script type="text/javascript">

        function affCache(idDiv) {
            var div = document.getElementById(idDiv);
            if (div.style.display === "none"){
                div.style.display = "";
            }
        }

        $('#country').on('change', function(e){
            console.log(e);
            var country_id = e.target.value;
            affCache('div_ville');
            $.get('/json-cities?country_id=' + country_id,function(data) {
                $('#ville').empty();
                $.each(data, function(index, villeObj){
                    $('#ville').append('<option value="'+ villeObj.id +'">'+ villeObj.name +'</option>');
                })
            });
        });
    </script>
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

        $('.msf-form form fieldset:first-child').find('input').on('blur', function () {
            verifyFirstStep();
        });
        $('.msf-form form fieldset:last-child').find('input').on('blur', function () {
            var canSubmit = verifySecondStep();
            setTimeout(function () {
                $('.msf-form form').find('button[type=submit]').prop('disabled', !canSubmit);
            }, 100);
        });
        $('input[name="options"]').change(function () {
            var canSubmit = verifySecondStep();
            setTimeout(function () {
                $('.msf-form form').find('button[type=submit]').prop('disabled', !canSubmit);
            }, 100);
        });
    });

    function verifyFirstStep() {
        if (is_null_or_whithe_space($('#operation_name').val())) return false;

        if (is_null_or_whithe_space($('#operation_purpose').val())) return false;

        var date_start = $('#date_start').val();
        if (is_null_or_whithe_space(date_start)) return false;

        var date_end = $('#date_end').val();
        if (is_null_or_whithe_space(date_end)) return false;

        date_start = new Date(date_start);
        date_end = new Date(date_end);

        if (date_start.getTime() < (new Date().datePart().getTime())) return false;

        if (date_start.getTime() > date_end.getTime()) return false;

        return true;
    }

    function verifySecondStep() {
        const options = $('input[name=options]:checked').val();
        if (is_null_or_whithe_space(options)) return false;
        var email = '';
        switch (options) {
            case 'ENTREPRISE':
                if (is_null_or_whithe_space($('#name_enterprise').val())) return false;
                if (is_null_or_whithe_space($('input[name="user_name_entreprise"]').val())) return false;
                if (is_null_or_whithe_space($('input[name="user_password_entreprise"]').val())) return false;
                email = $('input[name="user_email_entreprise"]').val();
                if (is_null_or_whithe_space(email)) return false;
                if (!is_valid_email(email)) return false;
                break;
            case 'PARTICULIER':
                if (is_null_or_whithe_space($('input[name="user_name"]').val())) return false;
                if (is_null_or_whithe_space($('input[name="user_password"]').val())) return false;

                email = $('input[name="user_email"]').val();
                if (is_null_or_whithe_space(email)) return false;
                if (!is_valid_email(email)) return false;

                break;
            default:
                return false;
        }

        return true;
    }
</script>

<script src="{{asset('multiform/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('multiform/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('multiform/assets/js/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('common/functions.js')}}"></script>
<script src="{{asset('multiform/assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
@endsection




