@extends('layouts.frontend.app')

@section('content')


    <!-- <div class="js-fullheight"> -->
        <div class="hero-wrap">
          <div class="overlay"></div>
          <div class="circle-bg"></div>
          <div class="circle-bg-2"></div>
          <div class="container-fluid">
            <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
              <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('footer_career') }}</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('footer_career') }}</h1>
              </div>
            </div>
          </div>
        </div>




        <section class="ftco-section ftco-degree-bg">
            <div class="container" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
              <div class="row">
                <div class="col-md-4 sidebar ftco-animate "  id="header">

                    <div class="sidebar-box ftco-animate">
                      <div class="categories">
                        <h3>{{ trans('carriere') }}</h3>
                        <li ><a href="#1" >{{ trans('Recrutement opérateur') }} </a></li>
                        <li><a href="#2">{{ trans('Offres de stages') }} </a></li>
                        <li><a href="#3">{{ trans('Offre d’emploi') }} </a></li>

                      </div>
                    </div>
                  </div>
                <div class="col-md-8 ftco-animate smooth-scroll list-unstyled " id="font" style="">

                    <h2 class="mb-3 mt-5">{{ trans('carriere1') }}</h2>
                    <p>{{ trans('carriere2') }}</p>
                    <p>{{ trans('carriere3') }}</p>

                  <h2 id="1" class="mb-3 mt-5">{{ trans('Recrutement opérateur') }}</h2>
                  <p>{{ trans('carriere5') }}</p>
                  <div class="row">
                    <div class="col-9 cocustom-file">
                        <input type="file" class="custom-file-input" id="customFileLang" lang="fr">
                        <label class="custom-file-label" id="customFileLang"  for="customFileLang">Sélectionner le fichier </label>
                      </div>
                      <div class="col-3"> <button type="button" id="btn-btn" class="btn-info">Envoyer votre cv</button></div>
                  </div>

                  <h2 id="2" class="mb-3 mt-5">{{ trans('Offres de stages') }}</h2>
                  <p>{{ trans('Offree') }}</p>
                  <div class="row">
                    <div class="col-9 cocustom-file">
                        <input type="file" class="custom-file-input" id="customFileLang" lang="fr">
                        <label class="custom-file-label" id="customFileLang"  for="customFileLang">Sélectionner le fichier </label>
                      </div>
                      <div class="col-3"> <button type="button" id="btn-btn" class="btn-info">Envoyer votre cv</button></div>
                  </div>

                  <h2 id="3" class="mb-3 mt-5">{{ trans('Offre d’emploi') }}</h2>
                  <p>{{ trans('carriere6') }}</p>

                  <div class="panel panel-primary">
                    <div class="panel-heading"></div>
                    <div class="panel-body">

                      @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>{{ $message }}</strong>
                      </div>
                      <img src="uploads/{{ Session::get('file') }}">
                      @endif

                      @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <strong>Whoops!</strong> There were some problems with your input.
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif

                      <form   action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row">


                              <div class="col-9 cocustom-file">

                                <input id="type_offre" name="type_offre" type="hidden" value="Offre d’emploi">

                                  <input type="file" class="custom-file-input" id="customFileLang" lang="fr">
                                  <label class="custom-file-label" id="customFileLang"  for="customFileLang">Sélectionner le fichier </label>
                                </div>
                              <div class="class="col-3>
                                  <button type="submit" id="btn-btn" class="btn-success">Envoyer votre cv</button>
                              </div>
                            </div>
                          </div>
                      </form>


                  </div>


                  </div>
                </div> <!-- .col-md-8 -->
              </div>
            </div>
          </section> <!-- .section -->

<br> 

@endsection
