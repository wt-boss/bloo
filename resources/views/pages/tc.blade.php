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


    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-5">
    			<div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">{{ trans('t&c') }}</span>
            <p class="mb-4"> {{ trans('title_t&c') }}</p>
          </div>
    		</div>
    		<div class="row">
          <div class="col-md-12 nav-link-wrap mb-5 pb-md-5 pb-sm-1 ftco-animate">
            <div class="nav ftco-animate nav-pills justify-content-center text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-nextgen-tab" data-toggle="pill" href="#v-pills-nextgen" role="tab" aria-controls="v-pills-nextgen" aria-selected="true">{{ trans('title1_t&c') }}</a>

              <a class="nav-link" id="v-pills-performance-tab" data-toggle="pill" href="#v-pills-performance" role="tab" aria-controls="v-pills-performance" aria-selected="false">{{ trans('title2_t&d') }}</a>

              <a class="nav-link" id="v-pills-effect-tab" data-toggle="pill" href="#v-pills-effect" role="tab" aria-controls="v-pills-effect" aria-selected="false">{{ trans('title3_t&c') }}</a>
            </div>
          </div>
          <div class="col-md-12 align-items-center ftco-animate">

            <div class="tab-content ftco-animate" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
              	<div class="d-md-flex">
	              	<div class="one-forth align-self-center">
	              		<img src="{{ asset('assets/images/dashboard_full_1.jpg') }}" class="img-fluid border" alt="">
	              	</div>
	              	<div class="one-half ml-md-5 align-self-center">
		                <h2 class="mb-4">{{ trans('title1_t&c') }}</h2>
		              	<p>{{ trans('content') }}</p>
		              </div>
	              </div>
              </div>

              <div class="tab-pane fade" id="v-pills-performance" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                <div class="d-md-flex">
	              	<div class="one-forth order-last align-self-center">
	              		<img src="{{ asset('assets/images/dashboard_full_1.jpg') }}" class="img-fluid border" alt="">
	              	</div>
	              	<div class="one-half order-first mr-md-5 align-self-center">
		                <h2 class="mb-4">{{ trans('title2_t&d') }}</h2>
		              	<p>{{ trans('content2') }}</p>
                        <p>{{ trans('content2.1') }}</p>
		              </div>
	              </div>
              </div>

              <div class="tab-pane fade" id="v-pills-effect" role="tabpanel" aria-labelledby="v-pills-effect-tab">
                <div class="d-md-flex">
	              	<div class="one-forth align-self-center">
	              		<img src="{{ asset('assets/images/dashboard_full_1.jpg') }}" class="img-fluid border" alt="">
	              	</div>
	              	<div class="one-half ml-md-5 align-self-center">
		                <h2 class="mb-4">{{ trans('title3_t&c') }}</h2>
                          <p>{{ trans('content3') }}</p>
                          <p>{{ trans('content3.1') }}</p>

		              </div>
	              </div>
              </div>
            </div>
          </div>

        </div>

        <br> <br>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div id="accordion">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header">
                                      <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone">{{ trans('title04_t&c') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menuone" class="collapse show">
                              <div class="card-body">
                                    <p>{{ trans('content04') }}</p>
                                    <p>{{ trans('content41') }}</p>
                                   <p>{{ trans('content42') }}</p>
                                    <p>{{ trans('content43') }}</p>
                                    <p>{{ trans('content44') }}</p>
                                 <p>{{ trans('content45') }}</p>
                              </div>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-header">
                                      <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="false" aria-controls="menutwo">{{ trans('title4_t&c') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menutwo" class="collapse">
                              <div class="card-body">
                                <p>{{ trans('content4') }}</p>
                                <p>{{ trans('content4.1') }}</p>
                                <p>{{ trans('conten4.2') }}</p>
                                <p>{{ trans('conten4.3') }}</p>
                                 <p>{{ trans('conten4.4') }}</p>
                                 <p>{{ trans('conten4.5') }}</p>
                                 <p>{{ trans('conten4.6') }}</p>

                            </div>
                            </div>
                          </div>


                        </div>

                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header">
                                      <a class="card-link" data-toggle="collapse"  href="#menu4" aria-expanded="false" aria-controls="menu4">{{ trans('title5_t&c') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menu4" class="collapse">
                              <div class="card-body">
                                    p> {{ trans('content5') }}</p>
                                    p> {{ trans('content51') }}</p>
                               </div>
                            </div>
                          </div>

                          <div class="card">
                                <div class="card-header">
                                        <a class="card-link" data-toggle="collapse"  href="#menu5" aria-expanded="false" aria-controls="menu5">{{ trans('title6_t&c') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                </div>
                                <div id="menu5" class="collapse">
                                    <div class="card-body">
                                                    <p>{{ trans('content6') }}</p>
                                                    <p>{{ trans('content61') }}</p>
                                    </div>
                                </div>
                          </div>
                          <div class="card">
                            <div class="card-header">
                                      <a class="card-link" data-toggle="collapse"  href="#menu6" aria-expanded="false" aria-controls="menu6">{{ trans('title7_t&c') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                            </div>
                            <div id="menu6" class="collapse">
                              <div class="card-body">
                                <p>{{ trans('content7') }}</p>
                            </div>
                                </div>
                            </div>
                          </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    	</div>
    </section>

@endsection
