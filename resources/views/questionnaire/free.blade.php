



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
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Sondage gratuit</h1>
            </div>
        </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Creation du formulire gratuit</span>
                <h2 class="mb-4">Créer gratuitement un sondage, administré le et ayez accès aux statistiques de ce sonndage </h2>

            </div>
        </div>
        <div class="row">

            <div class="col-md-12 align-items-center ftco-animate">

                <div class="tab-content ftco-animate" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                        <div class="d-md-flex">
                            <div class="one-forth align-self-center">
                                <img src="{{asset('assets/images/dashboard_full_1.jpg') }}" class="img-fluid border" alt="">
                            </div>
                            <div class="one-half ml-md-5 align-self-center">
                                      <center><h2>Créer votre sondage</h2></center>
                                            {!! Form::open(['route' => 'questionnaire.store_free']) !!}
                                            {!! Form::token();!!}
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="title">Titre</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre" required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="purpose">Objectif</label>
                                                    <input type="text" class="form-control" id="purpose"  name="purpose"  placeholder="Enter l'objectif">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="date_start">Date de debut</label>
                                                    <input type="date" class="form-control" id="date_start" name="date_start">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="date_end">Date de fin</label>
                                                    <input type="date" class="form-control" id="date_end" name="date_end">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Valider</button>
                                            {!! Form::close() !!}

                            </div>
                        </div>
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
