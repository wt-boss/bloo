
@extends('layouts.frontend.app')

@section('content')


<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{trans('free__home')}}</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Sondage gratuit</h1>
            </div>
        </div>
</div>

<section class="ftco-section sondages">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="subheading">{{trans('free_header0')}}</span>
                {{-- <h2 class="mb-4 text-justify">{{trans('free_header')}}</h2> --}}
            </div>

            <div class="col-md-12 align-items-center ftco-animate">
                <div class="tab-content ftco-animate" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                        <div class="d-md-flex">
                            <div class="one-half ml-md-5 align-self-center">
                                <p>
                                    {{ trans('sondage_content') }}
                                </p>
                            </div>
                            <div class="one-half ml-md-5 align-self-center">
                                <p>
                                    {{ trans('sondage_content1') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 align-items-center ftco-animate">
                <div class="tab-content ftco-animate" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                        <div class="d-md-flex">
                            <div class="one-forth align-self-center">

                                <center><h2>{{trans('free_content1')}}</h2></center>

                                <form action="{{route('forms.store_free')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="title">{{trans('free_form1_label1')}}</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="purpose">{{trans('free_form1_label2')}}</label>
                                            <input type="text" class="form-control" id="description"  name="description" placeholder="Entrer l'objectif" required >
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="purpose">Mot de passe</label>
                                            <input type="password" class="form-control" id="password"  name="password" required >
                                        </div>

                                        <div class="form-group col-6">

                                        </div>
                                        <div class="form-group col-6">
                                            <input type="submit" class="btn btn-primary col-12"/>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            <div class="one-half ml-md-5 align-self-center">
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
                                    <center><h2>{{trans('free_content2')}}</h2></center>
                                <form action="{{ route('forms.show_free') }}" method="post" >
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="token">Code du formulaire</label>
                                            <input id="code" type="text" class="form-control" name="code" placeholder="Entrer l'ID du sondage" required >
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="purpose">Mot de passe</label>
                                            <input type="password" class="form-control" id="password"  name="password" required >
                                        </div>

                                        <div class="form-group col-6">
                                        </div>
                                        <div class="form-group col-6">
                                            <input type="submit" class="btn btn-primary col-12"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
