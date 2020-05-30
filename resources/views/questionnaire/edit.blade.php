



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
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Edition du Sondage gratuit</h1>
            </div>
        </div>
    </div>

    <section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editer questionnaire</div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['questionnaire.update',$questionnaire->id],'method' => 'post']) !!}
                        {!! Form::token();!!}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="title">Titre</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre" required value="{{$questionnaire->title}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="purpose">Objectif</label>
                                <input type="text" class="form-control" id="purpose"  name="purpose"  placeholder="Enter l'objectif" value="{{$questionnaire->purpose}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="date_start" >Date de debut</label>
                                <input type="date" class="form-control" id="date_start" name="date_start" value="{{$start}}" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="date_end">Date de fin</label>
                                <input type="date" class="form-control" id="date_end" name="date_end"  value="{{$end}}"  required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
