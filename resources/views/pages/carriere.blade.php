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

                
                  @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="custom-file">
                        <input type="hidden" name="name_cv" value="cv pour Recrutement opérateur">
                      <input type="file" name="filename[]" class="custom-file-input jt" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; border-right-width: 0px;
                      border-right-style: 6px;" id="customFileLang" >
                      <label class="custom-file-label" id="customFileLang"  style="margin-left: 18px;padding-right: 4.75rem;margin-right: 45px;" for="customFileLang"> </label>
                    </div>
                    <div class="col-3 offset-10" > <button type="submit" style="margin-top: 6px;" id="btn-btn" class="btn-info">Envoyer </button></div>
                  </form>
             
                 

                  <h2 id="2" class="mb-3 mt-5">{{ trans('Offres de stages') }}</h2>
                  <p>{{ trans('Offree') }}</p>
                  @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="custom-file">
                        <input type="hidden" name="name_cv" value="cv pour demande de stage">
                      <input type="file" name="filename[]" class="custom-file-input jt" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; border-right-width: 0px;
                      border-right-style: 6px;" id="customFileLang" >
                      <label class="custom-file-label" id="customFileLang"  style="margin-left: 18px;padding-right: 4.75rem;margin-right: 45px;" for="customFileLang"> </label>
                    </div>
                    <div class="col-3 offset-10" > <button type="submit" style="margin-top: 6px;" id="btn-btn" class="btn-info">Envoyer </button></div>
                  </form>

                  <h2 id="3" class="mb-3 mt-5">{{ trans('Offre d’emploi') }}</h2>
                  <p>{{ trans('carriere6') }}</p>

                  @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="custom-file">
                        <input type="hidden" name="name_cv" value="cv Demande Emplois">
                      <input type="file" name="filename[]" class="custom-file-input jt" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; border-right-width: 0px;
                      border-right-style: 6px;" id="customFileLang" >
                      <label class="custom-file-label" id="customFileLang"  style="margin-left: 18px;padding-right: 4.75rem;margin-right: 45px;" for="customFileLang"> </label>
                    </div>
                    <div class="col-3 offset-10" > <button type="submit" style="margin-top: 6px;" id="btn-btn" class="btn-info">Envoyer </button></div>
                  </form>
                      


                  </div>


                  </div>
                </div> <!-- .col-md-8 -->
              </div>
            </div>
          </section> <!-- .section -->

<br>

@endsection

@section('js')

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
@endsection
