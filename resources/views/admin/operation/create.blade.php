@extends('admin.top-nav')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>Création d'un utilisateur</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
        <li><a href="#"><i class="fas fa-user"></i> Users </a></li>
        <li class="active">Créer</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box" style="border:1px solid #d2d6de;">
                <form method="post" action="{{ route('operation.store') }}">
                    @csrf
                    <input class="form-control" type="text" name="nom_operation" placeholder="Nom ">
                    <input class="form-control" type="date" name="date_debut" placeholder="Date de debut">
                    <input class="form-control" type="date" name="date_fin" placeholder="Date de fin">
                    <input class="form-control" type="text" name="nom_formulaire" placeholder="nom formulaire">
                    <input class="form-control" type="text" name="description_formulaire" placeholder="description formulaire">
                    <button type="submit" class="btn btn-info" style="width:100px;">Sauvegarder</button>
                    <a class="btn btn-warning " href="{{ route('users.index') }}"
                        style="width:100px;"><i class="fa fa-btn fa-back"></i>Annuler</a>
                </form>
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
<script type="text/javascript">
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
