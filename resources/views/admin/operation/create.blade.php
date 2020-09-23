@extends('admin.top-nav')
@section('page_title', trans('footer_btn'))
@section('content-header')
<!-- Content Header (Page header) -->
@endsection

@section('content')


@include('partials.alert', ['name' => 'index'])
<div class="panel panel-flat">
    <div class="row">
        <div class="d-none d-sm-block col-sm-5 left-side-bloo">
            <img class="bg-img" src="{{ asset('assets/images/background_create_enterprise.jpg') }}" alt="" />
            {{-- <img class="logo-img" src="{{ asset('assets/images/bloo_logo-white.png') }}" alt="Bloo" /> --}}
            <h1>@lang('create_operation_title')</h1>
        </div>
        <div class="col-sm-7">
            <div class="my-content">
                <div class="pull-right">
                    <a href="{{ route('operation.index') }}" class="btn btn-bloo-w heading-btn">@lang('next')</a>
                </div>
                <h2 class="bloo-primary left-side-bloo border-left-primary">@lang('create_operation')</h2>
                <p class="text-justify">

                </p>
                <form method="post" action="{{ route('operation.store') }}" id="sondage-form">
                    @csrf
                    <div class="row">
                        @if(isset($entreprise))
                            <select class="form-control" name="entreprise_id">
                                <option value="{{$entreprise->id}}">{{$entreprise->nom}}</option>
                            </select>
                            <div class="mik-invalid-feedback">
                                @lang('field_cant_be_nil')
                            </div>
                        @else
                            <select class="form-control" name="entreprise_id">
                                @foreach($entreprises as $entreprise)
                                    <option  value="{{$entreprise->id}}">{{$entreprise->nom}}</option>
                                @endforeach
                            </select>
                            <div class="mik-invalid-feedback">
                                @lang('field_cant_be_nil')
                            </div>
                        @endif
                    </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="bloo-bloc col-md-5 text-center b-first">
                            <p class="op-title">@lang('named_operation')</p>
                            <input name="nom_operation" class="form-control form-input-check" type="text" placeholder="@lang('pholder_formname')">
                            <div class="mik-invalid-feedback">
                                {{ trans('field_cant_be_nil') }}
                            </div>
                        </div>
                        <div class="col-md-5 bloo-bloc col-md-offset-1">
                            <div class="row">
                                <div class="col-xs-6">
                                    <p class="op-title">@lang('Start')</p>
                                    <input name="date_debut" class="form-control form-input-check" type="date">
                                    <div class="mik-invalid-feedback">
                                        {{ trans('field_cant_be_nil') }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <p class="op-title">@lang('End')</p>
                                    <input name="date_fin" class="form-control form-input-check" type="date">
                                    <div class="mik-invalid-feedback">
                                        {{ trans('field_cant_be_nil') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bloo-bloc col-md-5 text-center b-first">
                            <p class="op-title">@lang('form_name')</p>
                            <input class="form-control form-input-check" name="nom_formulaire" type="text" placeholder="@lang('pholder_formname')">
                            <div class="mik-invalid-feedback">
                                @lang('field_cant_be_nil')
                            </div>
                        </div>
                        <div class="col-md-5 bloo-bloc text-center col-md-offset-1">
                            <p class="op-title">@lang('form_description')</p>
                            <input class="form-control form-input-check" type="text" name="description_formulaire" placeholder="@lang('pholder_description')">
                            <div class="mik-invalid-feedback">
                                @lang('field_cant_be_nil')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-11 mt-10">
                        <button type="submit" class="pull-right btn btn-bloo">@lang('save')</button>
                    </div>
                </div>

                    {{-- <button type="button" class="btn btn-bloo btn-bloo-action" disabled id="btn-add-reader">Ajout lecteur</button> --}}
                    {{-- <button type="button" class="btn btn-bloo btn-bloo-action" disabled id="btn-add-operator">Ajout Operateur</button> --}}
                    {{-- <button type="button" class="btn btn-bloo btn-bloo-action" disabled id="btn-add-place">Ajout zone</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box" style="border:1px solid #d2d6de;">

            </div>
        </div>
    </div>
</section>
@endsection

@section('laraform_script1')
<script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
<script src="{{asset('common/functions.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#list').on('click', function (e) {
            console.log(e);
            $.get('/listlecteurs', function (data) {
                console.log(data);
                $('#listlecteur').empty();
                $.each(data, function (index, lecteurObj) {
                    $('#listlecteur').append(
                        '<input type="button" class="onelecteur" id="onelecteur" value="' +
                        lecteurObj.first_name + '">');
                    setTimeout(addlecteur, 400);
                })
            });
        });

        //Send form if valid
        $("#sondage-form").on('submit', function(e){
            let valid = validateForm();
            if(!valid){
                e.preventDefault();;
            }
        });

        //controle form on navigate
        $('.form-control').focus(function(){
            $(this).removeClass("mik-is-invalid");
            $(this).next(".mik-invalid-feedback").hide();
        });

        $('.form-input-check').focusout(function(){
            if (is_null_or_whithe_space($(this).val())){
                $(this).addClass("mik-is-invalid");
                $(this).next(".mik-invalid-feedback").show();
            }
        });

    });


    function validateForm() {
        if (is_null_or_whithe_space($('input[name="nom_operation"]').val())){
            $('input[name="nom_operation"]').addClass("mik-is-invalid");
            $('input[name="nom_operation"]').next(".mik-invalid-feedback").css("display", "block");
            return false;
        }

        var date_start = $('input[name="date_debut"]').val();
        if (is_null_or_whithe_space(date_start)){
            $('input[name="date_debut"]').addClass("mik-is-invalid");
            $('input[name="date_debut"]').next(".mik-invalid-feedback").show();
            $('input[name="date_debut"]').next(".mik-invalid-feedback").html("Ce champ ne peut être vide");
            return false;
        }

        var date_end = $('input[name="date_fin"]').val();
        if (is_null_or_whithe_space(date_end)) {
            $('input[name="date_fin"]').addClass("mik-is-invalid");
            $('input[name="date_fin"]').next(".mik-invalid-feedback").show();
            $('input[name="date_fin"]').next(".mik-invalid-feedback").html("Ce champ ne peut être vide");
            return false;
        }

        date_start = new Date(date_start);
        date_end = new Date(date_end);

        if (date_start.getTime() < (new Date().datePart().getTime())) {
            $('input[name="date_debut"]').addClass("mik-is-invalid");
            $('input[name="date_debut"]').next(".mik-invalid-feedback").show();
            $('input[name="date_debut"]').next(".mik-invalid-feedback").html("Choisir une date supérieure à la date du jour");
            return false;
        }

        if (date_start.getTime() > date_end.getTime()) {
            $('input[name="date_fin"]').addClass("mik-is-invalid");
            $('input[name="date_fin"]').next(".mik-invalid-feedback").show();
            $('input[name="date_fin"]').next(".mik-invalid-feedback").html("Choisir une date supérieure à la date de début");
            return false;
        }

        if (is_null_or_whithe_space($('input[name="nom_formulaire"]').val())) {
            $('input[name="nom_formulaire"]').addClass("mik-is-invalid");
            $('input[name="nom_formulaire"]').next(".mik-invalid-feedback").show();
            return false;
        }

        if (is_null_or_whithe_space($('input[name="description_formulaire"]').val())){
            $('input[name="description_formulaire"]').addClass("mik-is-invalid");
            $('input[name="description_formulaire"]').next(".mik-invalid-feedback").show();
            return false;
        }

        if (!$('select[name="entreprise_id"]').val()){
            $('select[name="entreprise_id"]').addClass("mik-is-invalid");
            $('select[name="entreprise_id"]').next(".mik-invalid-feedback").show();
            return false;
        }

        return true;
    }

    function addlecteur() {
        $('.onelecteur').on('click', function (e) {
            console.log(e);
            $.get('/listlecteurs', function (data) {
                console.log(data);
            });
            var lecteur_id = e.target.first_name;
            console.log(lecteur_id);
        });
    }

</script>
@endsection
