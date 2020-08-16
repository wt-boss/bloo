@extends('admin.top-nav')

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
            <h1>Creez une operation</h1>
        </div>
        <div class="col-sm-7">
            <div class="my-content">
                <div class="pull-right">
                    <a href="{{ route('operation.index') }}" class="btn btn-bloo-w heading-btn">Suivant</a>
                </div>
                <h2 class="bloo-primary left-side-bloo border-left-primary">Creez un sondage !</h2>
                <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt
                </p>
                <form method="post" action="{{ route('operation.store') }}">
                    @csrf
                    <div class="row">
                        @if(isset($entreprise))
                            <select class="form-control" name="entreprise_id">
                                <option value="{{$entreprise->id}}">{{$entreprise->nom}}</option>
                            </select>
                        @else
                        <select class="form-control" name="entreprise_id">
                            @foreach($entreprises as $entreprise)
                                <option  value="{{$entreprise->id}}">{{$entreprise->nom}}</option>
                                @endforeach
                        </select>
                        @endif
                    </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="bloo-bloc col-md-5 text-center b-first">
                            <p class="op-title">Nommer votre operation</p>
                            <input name="nom_operation" class="form-control" type="text" placeholder="Ex : Municipales 2030">
                        </div>
                        <div class="col-md-5 bloo-bloc col-md-offset-1">
                            <div class="row">
                                <div class="col-xs-6">
                                    <p class="op-title">Debut</p>
                                    <input name="date_debut" class="form-control" type="date">
                                </div>
                                <div class="col-xs-6">
                                    <p class="op-title">Fin</p>
                                    <input name="date_fin" class="form-control" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bloo-bloc col-md-5 text-center b-first">
                            <p class="op-title">Nom du formulaire</p>
                            <input class="form-control" name="nom_formulaire" type="text" placeholder="Ex : Municipales 2030">
                        </div>
                        <div class="col-md-5 bloo-bloc text-center col-md-offset-1">
                            <p class="op-title">description du formulaire</p>
                            <input class="form-control" type="text" name="description_formulaire" placeholder="Ex : Description des objectifs du formulaire">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-11 mt-10">
                        <button type="submit" class="pull-right btn btn-bloo">Enregistrer</button>
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
    // $(document).ready(function () {
    //     $('.btn-bloo-action').prop('disabled', true);

    //     $('form input, form select').on('keyup', function () {
    //         var canSubmit = validateForm();
    //         setTimeout(function () {
    //             $('form').find('button[type=submit]').prop('disabled', !canSubmit);
    //         }, 100);
    //     });
    // });

    function validateForm() {
        if (is_null_or_whithe_space($('input[name="nom_operation"]').val())) return false;

        var date_debut = $('input[name="date_debut"]').val();
        if (is_null_or_whithe_space(date_debut)) return false;

        var date_fin = $('input[name="date_fin"]').val();
        if (is_null_or_whithe_space(date_fin)) return false;

        if (is_null_or_whithe_space($('input[name="nom_formulaire"]').val())) return false;
        if (is_null_or_whithe_space($('input[name="description_formulaire"]').val())) return false;
        if (is_null_or_whithe_space($('select[name="entreprise_id"]').val())) return false;

        date_debut = new Date(date_debut);
        date_fin = new Date(date_fin);

        alert(date_debut + " " + date_fin);

        if (date_debut.getTime() < (new Date().datePart().getTime())) return false;
        if (date_debut.getTime() > date_fin.getTime()) return false;

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

</script>
@endsection
