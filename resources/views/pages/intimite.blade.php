@extends('layouts.frontend.app')

@section('page_title')
    {{ trans('privacy_title') }}
@endsection

@section('content')

<!-- <div class="js-fullheight"> -->
    <div class="hero-wrap">
      <div class="overlay"></div>
      <div class="circle-bg"></div>
      <div class="circle-bg-2"></div>
      <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('footer_privacy') }}</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('footer_privacy') }}</h1>
          </div>
        </div>
      </div>
    </div>
</div>
<section class="ftco-section ftco-degree-bg">
    <div class="container" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
      <div class="row">
        <div class="col-md-4 sidebar ftco-animate ">

            <div class="sidebar-box ftco-animate" style="padding-top: 0px;">
              <div class="categories">
                <h3>{{ trans('footer_privacy') }}</h3>
                <li ><a href="#1" >{{ trans('politique_quide2') }} </a></li>
                <li><a href="#2">{{ trans('politique_quide3') }} </a></li>
                <li><a href="#3">{{ trans('politique_quide4') }} </a></li>
                <li><a href="#4">{{ trans('politique_quide5') }} </a></li>
                <li><a href="#5">{{ trans('politique_quide6') }} </a></li>
                <li><a href="#6">{{ trans('politique_quide7') }} </a></li>
                <li><a href="#7">{{ trans('politique_quide62') }} </a></li>
                <li><a href="#8">{{ trans('politique_quide66') }} </a></li>
                <li><a href="#9">{{ trans('politique_quide68') }} </a></li>
                <li><a href="#10">{{ trans('guide141') }} </a></li>
              </div>
            </div>
          </div>
        <div class="col-md-8 ftco-animate smooth-scroll list-unstyled " id="font"  >
          <h2  class="mb-3">{{ trans('pollitique_title') }}</h2>
          <p>{{ trans('politique_content') }}</p>
          <p>{{ trans('politique_content1') }}</p>
          <h2 class="mb-3 mt-5">{{ trans('politique_quide') }}</h2>
          <ol style="color: #0065A1;">
          <li><a href="#1">{{ trans('guide1') }}</a></li>
          <li><a href="#2">{{ trans('guide3') }}</a></li>
          <li><a href="#3">{{ trans('guide4') }}</a></li>
          <li><a href="#4">{{ trans('guide5') }}</a></li>
          <li><a href="#5">{{ trans('guide6') }}</a></li>
          <li><a href="#6">{{ trans('guide7') }}</a></li>
          <li><a href="#7">{{ trans('guide8') }}</a></li>
          <li><a href="#8">{{ trans('guide9') }}</a></li>
          <li><a href="#9">{{ trans('guide10') }}</a></li>
          </ol>
          <p><a href=""></a>   {{ trans('guide') }}</p>


          <h2 id="1" class="mb-3 mt-5">{{ trans('politique_quide2') }}</h2>
          <p>{{ trans('guide12') }}</p>
          <p>{{ trans('guide13') }}</p>
          <p>{{ trans('quide14') }}</p>
          <p>{{ trans('quide15') }}</p>
          <p>{{ trans('quide16') }}</p>
          <p>{{ trans('guide17') }}</p>

          <h2 id="2" class="mb-3 mt-5">{{ trans('politique_quide3') }}</h2>
          <p>{{ trans('guide21') }}</p>
          <p>{{ trans('guide22') }}</p>

          <h2 id="3" class="mb-3 mt-5">{{ trans('politique_quide4') }}</h2>
          <p>{{ trans('guide31') }}</p>
          <p>{{ trans('guide32') }}</p>

          <h2 id="" class="mb-3 mt-5">{{ trans('politique_quide5') }}</h2>
          <p>{{ trans('guide33') }}</p>
          <p>{{ trans('guide34') }}</p>
          <p>{{ trans('guide35') }}</p>
          <p>{{ trans('guide36') }}</p>

          <h2 id="4" class="mb-3 mt-5">{{ trans('politique_quide6') }}</h2>
          <p>{{ trans('guide41') }}</p>
          <p>{{ trans('guide42') }}</p>
          <p>{{ trans('guide43') }}</p>

          <h2 id="5" class="mb-3 mt-5">{{ trans('politique_quide7') }}</h2>
          <p>{{ trans('guide51') }}</p>
          <p>{{ trans('guide52') }}</p>
          <p>{{ trans('guide54') }}</p>
          <p>{{ trans('guide55') }}</p>

          <h2 class="mb-3 mt-5">{{ trans('politique_quide8') }}</h2>
          <p>{{ trans('guiuide61') }}</p>

          <h2 id="6" class="mb-3 mt-5">{{ trans('politique_quide62') }}</h2>
          <p>{{ trans('politique_quide63') }}</p>
          <p>{{ trans('politique_quide64') }}</p>
          <p>{{ trans('politique_quide63') }}</p>

          <h2 id="7" class="mb-3 mt-5">{{ trans('politique_quide66') }}</h2>
          <p>{{ trans('politique_quide67') }}</p>

          <h2 id="8" class="mb-3 mt-5">{{ trans('politique_quide68') }}</h2>
          <p>{{ trans('politique_quide69') }}</p>

          <h2 class="mb-3 mt-5">{{ trans('politique_guide9') }}</h2>
          <p>{{ trans('politique_guide') }}</p>
          <p>{{ trans('guide91') }}</p>
          <p>{{ trans('guide92') }}</p>
          <p>{{ trans('guide93') }}</p>
          <p>{{ trans('guide94') }}</p>
          <p>{{ trans('guide95') }}</p>
          <p>{{ trans('guide96') }}</p>
          <p>{{ trans('guide97') }}</p>
          <p>{{ trans('guide98') }}</p>
          <p>{{ trans('guide99') }}</p>
          <p>{{ trans('guide11') }}</p>

          <h2 id="9" class="mb-3 mt-5">{{ trans('guide141') }}</h2>
          <p>{{ trans('politique_guide') }}</p>
          <p>{{ trans('guide14') }}</p>

          <h2 id="10" class="mb-3 mt-5">{{ trans('guide142') }}</h2>
          <p>{{ trans('guide143') }}</p>
          <p>{{ trans('guide144') }}</p>




          </div>




        </div> <!-- .col-md-8 -->


      </div>
    </div>
  </section> <!-- .section -->



@endsection
