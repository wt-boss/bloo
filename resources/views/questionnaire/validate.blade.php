



@extends('layouts.frontend.app')

@section('content')
@section('title', 'BLOO')

@push('css')
@endpush
<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('service_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Validation du sondage gratuit</h1>
            </div>
        </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <center><h1>Valider votre formulaire</h1></center>
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
                    <div class="form-group col-8" >
                        <label for="exampleInputEmail1">Token</label>
                        <input type="text" class="form-control" id="token" aria-describedby="token" value="{{$questionnaire->token}}" disabled>
                        <small id="token" class="form-text text-muted">Vous devez garder ce token pour avoir acces a votre formulaire plus tard</small>
                    </div>
                    <div class="form-group col-4">
                        <label for="exampleInputEmail1">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="password">
                        <small id="password"  class="form-text text-muted">Entrer un mot de passe pour avoir acces a votre formulaire prochainement</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>

</section>

@push('js')


@endpush
@endsection
@section('scripts')


@endsection
