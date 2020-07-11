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
    <div class="container">
        <div class="row">
            <div class="col-md-4 sidebar ftco-animate"  id="header">
                <div class="sidebar-box ftco-animate" style="padding-top: 0px;">
                    <div class="categories">
                        <h3>{{ trans('carriere') }}</h3>
                        <li ><a href="#1" >{{ trans('Recrutement opérateur') }} </a></li>
                        <li><a href="#2">{{ trans('Offres de stages') }} </a></li>
                        <li><a href="#3">{{ trans('Offre d’emploi') }} </a></li>
                    </div>
                </div>
            </div> <!-- .col-md-4 -->

            <div class="col-md-8 ftco-animate">
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
                                    <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone">{{ trans('Recrutement opérateur') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                </div>
                                <div id="menuone" class="collapse show">
                                    <div class="card-body">
                                    <p>{{ trans('carriere5') }}</p>
                                    <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="custom-file col-12">
                                                <input type="hidden" name="name_cv" value="cv pour Recrutement opérateur">
                                                <input type="file" name="filename[]" class="custom-file-input jt" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; border-right-width: 0px; border-right-style: 6px;" id="customFileOp" >
                                                <label class="custom-file-label" style="margin-left: 18px;padding-right: 4.75rem;margin-right:15px;" for="customFileOp"> </label>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="btn-btn" class="btn-info float-right">Envoyer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                    <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="false" aria-controls="menutwo">{{ trans('Offres de stages') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menutwo" class="collapse">
                                <div class="card-body">
                                    <p>{{ trans('Offree') }}</p>
                                    <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="custom-file col-12">
                                                <input type="hidden" name="name_cv" value="cv pour demande stage">
                                                <input type="file" name="filename[]" class="custom-file-input jt" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; border-right-width: 0px; border-right-style: 6px;" id="customFileIntern" >
                                                <label class="custom-file-label"  style="margin-left: 18px;padding-right: 4.75rem;margin-right:15px;" for="customFileIntern"> </label>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="btn-btn" class="btn-info float-right">Envoyer</button>
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
                                <a class="card-link" data-toggle="collapse"  href="#menu3" aria-expanded="false" aria-controls="menu3">{{ trans('Offre d’emploi') }}<span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menu3" class="collapse">
                                <div class="card-body">
                                    <p>{{ trans('carriere6') }}</p>
                                    <form action="{{ route('cv_submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="custom-file col-12">
                                                <input type="hidden" name="name_cv" value="cv Demande Emplois">
                                                <input type="file" name="filename[]" class="custom-file-input jt" style="border-right-width: 0px;border-right-style: 6px;margin-left: 23px; border-right-width: 0px; border-right-style: 6px;" id="customFileJob" >
                                                <label class="custom-file-label" style="margin-left: 18px;padding-right: 4.75rem;margin-right:15px;" for="customFileJob"> </label>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="btn-btn" class="btn-info float-right">Envoyer</button>
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
