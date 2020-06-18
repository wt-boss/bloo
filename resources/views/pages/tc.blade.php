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
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('footer_tc') }}</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('footer_tc') }}</h1>
              </div>
            </div>
          </div>
        </div>


        <section class="ftco-section ftco-degree-bg">
            <div class="container" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
              <div class="row">
                <div class="col-md-4 sidebar ftco-animate ">

                    <div class="sidebar-box ftco-animate">
                      <div class="categories">
                        <h3>{{ trans('t&c') }}</h3>
                        <li ><a href="#1" >{{ trans('title1_t&c') }} </a></li>
                        <li><a href="#2">{{ trans('title2_t&d') }} </a></li>
                        <li><a href="#3">{{ trans('title3_t&c') }} </a></li>
                        <li><a href="#4">{{ trans('title04_t&c') }} </a></li>
                        <li><a href="#5">{{ trans('title4_t&c') }} </a></li>
                        <li><a href="#5">{{ trans('title5_t&c') }} </a></li>
                        <li><a href="#6">{{ trans('title6_t&c') }} </a></li>
                        <li><a href="#7">{{ trans('title7_t&c') }} </a></li>
                      </div>
                    </div>
                  </div>
                <div class="col-md-8 ftco-animate smooth-scroll list-unstyled " id="font"  >
                  <h2 id="1" class="mb-3 mt-5">{{ trans('t&c') }}</h2>
                  <p>{{ trans('title_t&c') }}</p>

                  <h2 id="2" class="mb-3 mt-5">{{ trans('title1_t&c') }}</h2>
                  <p>{{ trans('content') }}</p>

                  <h2 id="3" class="mb-3 mt-5">{{ trans('title1_t&c') }}</h2>
                  <p>{{ trans('content') }}</p>


                  <h2 id="4" class="mb-3 mt-5">{{ trans('title2_t&d') }}</h2>
                  <p>{{ trans('content2') }}</p>
                  <p>{{ trans('content2.1') }}</p>

                  <h2 id="5" class="mb-3 mt-5">{{ trans('title3_t&c') }}</h2>
                  <p>{{ trans('content3') }}</p>
                  <p>{{ trans('content3.1') }}</p>

                  <h2 id="6" class="mb-3 mt-5">{{ trans('title04_t&c') }}</h2>
                  <p>{{ trans('content04') }}</p>
                  <p>{{ trans('content41') }}</p>
                  <p>{{ trans('content42') }}</p>
                  <p>{{ trans('content43') }}</p>
                  <p>{{ trans('content44') }}</p>
                  <p>{{ trans('content45') }}</p>

                  <h2 id="7" class="mb-3 mt-5">{{ trans('title4_t&c') }}</h2>
                  <p>{{ trans('content4') }}</p>
                  <p>{{ trans('content4.1') }}</p>
                  <p>{{ trans('conten4.2') }}</p>
                  <p>{{ trans('conten4.3') }}</p>
                  <p>{{ trans('conten4.4') }}</p>
                  <p>{{ trans('conten4.5') }}</p>
                  <p>{{ trans('conten4.6') }}</p>

                  <h2 id="8" class="mb-3 mt-5">{{ trans('title5_t&c') }}</h2>
                  <p>{{ trans('content5') }}</p>
                  <p>{{ trans('content51') }}</p>


                  <h2 id="8" class="mb-3 mt-5">{{ trans('title6_t&c') }}</h2>
                  <p>{{ trans('content6') }}</p>
                  <p>{{ trans('content61') }}</p>


                  <h2 class="mb-3 mt-5">{{ trans('title7_t&c') }}</h2>
                  <p>{{ trans('content7') }}</p>
                  </div>
                </div> <!-- .col-md-8 -->
              </div>
            </div>
          </section> <!-- .section -->

@endsection
