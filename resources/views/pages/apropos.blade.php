@extends('layouts.frontend.app')
@section('page_title', trans('footer_apropos'))

@section('content')

    <!-- <div class="js-fullheight"> -->
        <div class="hero-wrap other-p">
          <div class="overlay"></div>
          <div class="circle-bg"></div>
          <div class="circle-bg-2"></div>
          <div class="container-fluid">
            <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
              <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('footer_apropos') }}</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('footer_apropos') }}</h1>
              </div>
            </div>
          </div>
        </div>






      <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">{{ trans('contact_title') }}</span>
            <h2 class="mb-4">{{ trans('contact_content') }}</h2>
            <p>{{ trans('contact_infos') }}</p>
            <p>{{ trans('contact_infos1') }}</p>
            <p>{{ trans('contact_infos3') }}</p>
          </div>
        </div>

        </div>
    </section>

@endsection
