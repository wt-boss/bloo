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
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('prix_fil') }}</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('prix_fil') }}</h1>
              </div>
            </div>
          </div>
        </div>

        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5 pb-5">
              <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">{{ trans('prix_title') }}</span>{{ trans('') }}
                <h2 class="mb-4">{{ trans('prix_content') }}</h2>
              </div>
            </div>
                <div class="row">
                <div class="col-md-4">
                  <div class="block-7">
                    <div class="text-center">
                    <h2 class="heading">{{ trans('prix_free') }}</h2>
                    <span class="price"> <span class="number">{{ trans('prix1') }}</span></span>
                    <span class="excerpt d-block">{{ trans('prix_offre_freee') }}</span>
                    <br>
                    <a href="{{route('questionnaire.free')}}" class="btn btn-primary d-block px-3 py-3 mb-4">{{ trans('prix_btn') }}</a>



                    <h2 class="heading-2 mb-3">{{ trans('prix_introduc') }}</h2>
                    <hr>
                    <ul class="pricing-text">
                      <li><strong>{{ trans('prix_offre_free') }}</strong> </li>
                      <hr>

                      <li><strong>{{ trans('prix_offre_free1') }}</strong></li>
                      <hr>
                      <li><strong>{{ trans('prix_offre_free2') }}</strong></li>
                      <hr>
                      <li><strong>{{ trans('prix_offre_free3') }}</strong></li>
                    </ul>
                    <br>

                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class="block-7">
                      <div class="text-center">
                      <h2 class="heading">{{ trans('prix_prenuim') }}</h2>
                      <span class="price"> <span class="number">{{ trans('prix2') }}</span></span>
                      <span class="excerpt d-block">{{ trans('prix_introduc1') }}</span>
                      <a href="#" class="btn btn-primary d-block px-3 py-3 mb-4">{{ trans('prix_btn') }}</a>


                      <h3 class="heading-2 mb-3">{{ trans('prix_introduc') }}</h3>
                      <hr>

                      <ul class="pricing-text">
                        <li><strong>{{ trans('prix_offre_prenuim') }}</strong> </li>
                        <hr>
                        <li><strong>{{ trans('prix_offre_prenuim1') }}</strong></li>
                        <hr>
                        <li><strong>{{ trans('prix_offre_prenuim2') }}</strong></li>
                        <hr>
                        <li><strong>{{ trans('prix_offre_prenuim3') }}</strong></li>
                      </ul>
                      </div>
                    </div>
                </div>


                  <div class="col-md-4">
                    <div class="block-7">
                      <div class="text-center">
                      <h2 class="heading">{{ trans('prix_illimite') }}</h2>
                      <span class="price"> <span class="number">{{ trans('prix3') }}</span></span>
                      <span class="excerpt d-block">{{ trans('prix_introduc1') }}</span>
                      <a href="#" class="btn btn-primary d-block px-3 py-3 mb-4">{{ trans('prix_btn') }}</a>


                      <h3 class="heading-2 mb-3">{{ trans('prix_introduc') }}</h3>
                      <hr>

                      <ul class="pricing-text">
                        <li><strong>{{ trans('prix_offre_illimite') }}</strong> </li>
                        <hr>
                        <li><strong>{{ trans('prix_offre_illimite1') }}</strong></li>
                        <hr>
                        <li><strong>{{ trans('prix_offre_llimite2') }}</strong></li>
                        <hr>
                        <li><strong>{{ trans('prix_offre_llimite3') }}</strong></li>


                      </ul>
                      </div>
                    </div>
                  </div>

              </div>
            </div>
        </section>


@endsection
