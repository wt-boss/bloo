@extends('layouts.frontend.app')
@section('page_title', trans('footer_career'))
@section('content')
    <!-- <div class="js-fullheight"> -->
<div class="hero-wrap other-p">
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
    <div class="container">
        <div class="row">
            <div class="col-md-4 sidebar ftco-animate d-none d-md-block"  id="header" >
                <div id="hiddenImg" class="sidebar-box ftco-animate carriere-side-img  ">

                </div>
            </div> <!-- .col-md-4 -->

            <div class="col-md-8 col-sm-12 ftco-animate">
                <div class="heading-section">
                    <h3 class="subheading">{{ trans('carriere') }}</h3>
                </div>
                <h2>{{ trans('carriere1') }}</h2>
                <p>{{ trans('carriere2') }}</p>
                <p>{{ trans('carriere3') }}</p>
                <br><br>
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

                <div id="accordion" class="carriere">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone"> {{ trans('Recrutement_op') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                </div>
                                <div id="menuone" class="collapse show">
                                    <div class="card-body">
                                    <p>{{ trans('carriere5') }} {{ trans('carriere06') }} <a href="#"> {{ trans('carriere07') }} </a> {{ trans('carriere08') }} </p>
                                    <a href="#"> <img src="https://www.freepnglogos.com/images/app-store-png-logo-33115.html" alt=""></a>
                                    <a href="#" title="Image from freepnglogos.com"><img src="https://www.freepnglogos.com/uploads/app-store-logo-png/google-play-and-apple-app-store-logos-22.png" width="200" alt="google play and apple app store logos" /></a>
                                    {{-- 
                                        
                                         <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="custom-file col-12">
                                                <input type="hidden" name="name_cv" value="cv pour Recrutement opérateur">
                                                <input type="file" name="filename[]" class="custom-file-input jt"  id="customFileOp" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; margin-left: 231px; border-right-width: 0px; border-right-style: 6px;padding-bottom: 26px;">

                                                <label class="custom-file-label" style="margin-left: 18px;padding-right: 4.75rem;margin-right:15px;" for="customFileOp"> </label>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="btn-btn" class="btn-info float-right">{{ trans('envoyer') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                        --}}
                                   
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                    <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="false" aria-controls="menutwo">{{ trans('Offres de stages') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menutwo" class="collapse">
                                <div class="card-body">
                                    <p>{{ trans('Offree') }}
                                    </p>
                                    <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="custom-file col-12">
                                                <input type="hidden" name="name_cv" value="cv pour demande stage">
                                                <input type="file" name="filename[]" class="custom-file-input jt"  id="customFileIntern"  style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; margin-left: 231px; border-right-width: 0px; border-right-style: 6px;padding-bottom: 26px;">
                                                <label class="custom-file-label"  style="margin-left: 18px;padding-right: 4.75rem;margin-right:15px;" for="customFileIntern"> </label>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="btn-btn" class="btn-info float-right">{{ trans('envoyer') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse"  href="#menu3" aria-expanded="false" aria-controls="menu3">{{ trans('Offre emploi') }}<span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menu3" class="collapse">
                                <div class="card-body">
                                    <p>{{ trans('carriere6') }}</p>
                                    <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="custom-file col-12">
                                                <input type="hidden" name="name_cv" value="cv Demande Emplois">
                                                <input type="file" name="filename[]" class="custom-file-input jt"  id="customFileJob" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; margin-left: 231px; border-right-width: 0px; border-right-style: 6px;padding-bottom: 26px;" >
                                                <label class="custom-file-label" style="margin-left: 18px;padding-right: 4.75rem;margin-right:15px;" for="customFileJob"> </label>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="btn-btn" class="btn-info float-right">{{ trans('envoyer') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- #accordion --}}
            </div> <!-- .col-8 -->
        </div>
    </div>
</section> <!-- .section -->
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
