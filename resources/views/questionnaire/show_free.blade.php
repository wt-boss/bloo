



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
            <div class="row justify-content-center">

                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card">

                        <div class="card-header">
                            <div class="row">
                                <a href="{{route('take_survey',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-primary" value="Passer ce questionnaire"/></a>
                                <a href="{{route('questionnaire.edit',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-warning" value="Editer questionnaire"/></a>
                                @if($questionnaire->active == 0)
                                    <a href="{{route('questionnaire.active',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-secondary" value="Valider ce questionnaire"/></a>
                                @endif
                                <a href="{{route('questionnaire.stat',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-info float-right" value="Statistique questionnaire"/></a>
                            </div>
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
                            <ul class="list-group">
                                @forelse($questionnaire->questions as $question)
                                    <li class="list-group-item d-flex justify-content-between">{{$question->question}}
                                        @if( $question->responses->count() !== 0)
                                            <form action="/questionnaires/{{ $questionnaire->id}}/questions/{{$question->id}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimser cette question</button>
                                            </form>
                                        @endif
                                    </li>
                                @empty
                                    <li class="list-group-item">Pas de question dans ce formulaire</li>
                                @endforelse
                            </ul>
                            <br>
                            {!! Form::open(['route' => ['question.store',$questionnaire->id]]) !!}
                            {!! Form::token();!!}
                            <h5 class="text-uppercase text-justify">Ajouter une question</h5>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choisir votre option</label>
                                <select class="form-control" name="questions[question_type]" id="question_type">
                                    <option value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio Buttons</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">question</label>
                                <input type="text" class="form-control" name="questions[question]" >
                            </div>
                            <span class="form-g"></span>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('js')


@endpush
@endsection
@section('scripts')


@endsection
