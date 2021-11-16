@extends('layouts.frontend.app')

@section('content')

<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Gestion du sondage gratuit</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('take_survey',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-primary col-3" value="Prévisualiser"/></a>
                            <a href="{{route('questionnaire.edit',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-warning col-3 offset-1" value="Editer"/></a>
                            <a href="{{route('questionnaire.stat',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-info float-right col-3" value="Statistique"/></a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="titre">Titre</label>
                                    <input type="text" class="form-control" name="titre" id="titre" aria-describedby="titre" value="{{$questionnaire->title}}" disabled>
                                </div>
                                <div class="form-group col-6">
                                    <label for="objectif">Objectif</label>
                                    <input type="text" class="form-control" id="objectif" name="objectif" value="{{$questionnaire->purpose}}" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="date_start">Sondage ID</label>
                                    <input type="text" class="form-control" name="date_start" id="date_start" aria-describedby="titre" value="{{$questionnaire->token}}" disabled>
                                </div>

                                <div class="form-group col-6">
                                    <label for="date_start">Date de debut</label>
                                    <input type="text" class="form-control" name="date_start" id="date_start" aria-describedby="titre" value="{{$questionnaire->date_start}}" disabled>
                                </div>
                                <div class="form-group col-6">
                                    <label for="date_end">Date de fin</label>
                                    <input type="text" class="form-control" id="date_end" name="date_end" value="{{$questionnaire->date_end}}" disabled>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card mt-4">
                        <div class="card-header">Questions</div>
                        <div class="card-body">
                            @if (Session::has('errors'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <ul class="list-unstyled">
                                        @foreach (Session::get('errors')->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('warning'))
                                <div class="alert alert-warning" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    {{Session::get('warning')}}
                                </div>
                            @endif
                            @if (Session::has('info'))
                                <div class="alert alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    {{Session::get('info')}}
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    {{Session::get('success')}}
                                </div>
                                @endif
                            <ul class="list-group">
                                @forelse($questionnaire->questions as $question)
                                    <li class="list-group-item d-flex justify-content-between">{{$question->question}}
                                        @if( $question->responses->count() == 0)
                                            <form action="/questionnaires/{{ $questionnaire->id}}/questions/{{$question->id}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimser cette question</button>
                                            </form>
                                        @endif
                                    </li>
                                @empty
                                    <div class="alert alert-warning">Pas de question dans ce formulaire</div>
                                @endforelse
                            </ul>
                            <br>
                            {!! Form::open(['route' => ['question.store',$questionnaire->id]]) !!}
                            {!! Form::token();!!}

                            <h5 class="text-uppercase text-justify">Ajouter une question</h5>
                            <div class="form-group">

                                <label for="exampleFormControlSelect1">Type de question</label>
                                <select class="form-control" name="questions[question_type]" id="question_type">
                                    <option value="text">Texte court</option>
                                    <option value="number">Chiffre</option>
                                    <option value="textarea">Texte Long</option>
                                    <option value="checkbox">Choix multiple</option>
                                    <option value="radio">Choix Unique</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">question</label>
                                <input type="text" class="form-control" name="questions[question]" >
                            </div>
                            <span class="form-g"></span>
                            <input type="submit" class="btn btn-primary col-3" value="Ajouter"/>
                                @if($questionnaire->active == 0)
                                    <a href="{{route('questionnaire.confirm',[$questionnaire->slug])}}" class="col-3 float-right"> <input type="button" class="btn btn-secondary" value="Valider ce questionnaire"/></a>
                                @endif
                            {!! Form::close() !!}

                        </div>
                        <div class="card-footer">
                            <a href="{{route('take_survey',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-primary col-3" value="Prévisualiser"/></a>
                            <a href="{{route('questionnaire.edit',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-warning col-3 offset-1" value="Editer"/></a>
{{--                            <a href="{{route('questionnaire.stat',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-info float-right col-3" value="Statistique"/></a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>

@endsection
