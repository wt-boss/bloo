@extends('layouts.frontend.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Validation des informations du formulaire</div>
                    <div class="card-body">
                        <form method="post" action="{{route('questionnaire.validate_free',[$questionnaire->id])}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="titre">Titre</label>
                                    <input type="text" class="form-control" id="titre" aria-describedby="titre" value="{{$questionnaire->title}}" disabled>
                                </div>
                                <div class="form-group col-6">
                                    <label for="objectif">Objectif</label>
                                    <input type="text" class="form-control" id="objectif"  value="{{$questionnaire->purpose}}" disabled>
                                </div>
                                <div class="form-group col-12" >
                                    <label for="exampleInputEmail1">Token</label>
                                    <input type="text" class="form-control" id="token" aria-describedby="token" value="{{$questionnaire->token}}" disabled>
                                    <small id="token" class="form-text text-muted text-success">Vous devez garder ce token pour avoir acces a votre formulaire plus tard</small>
                                </div>
                                <div class=" offset-2 form-group col-4">
                                    <a href="">
                                        <input type="button" class="form-control"  value="Editer">
                                    </a>
                                </div>
                                <div class=" offset-2 form-group col-4">
                                    <a href="">
                                        <input type="password" class="form-control" value="statistiques">
                                    </a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
