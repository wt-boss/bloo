@extends('layouts.frontend.app')

@section('content')


<div class="js-fullheight">
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


        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
              <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">{{ trans('pollitique_title') }}</span>
                <h2 class="mb-4"> {{ trans('') }}</h2>
                    <p>{{ trans('politique_content') }}</p>
                    <p>{{ trans('politique_content1') }}</p>
              </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone">{{ trans('politique_quide') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menuone" class="collapse show">
                                      <div class="card-body">
                                          <p>{{ trans('guide1') }}</p>
                                          <p>{{ trans('guide2') }}</p>
                                          <p>{{ trans('guide3') }}</p>
                                           <p>{{ trans('guide4') }}</p>
                                           <p>{{ trans('guide6') }}</p>
                                           <p>{{ trans('guide7') }}</p>
                                           <p>{{ trans('guide8') }}</p>
                                           <p>{{ trans('guide9') }}</p>
                                           <p>{{ trans('guide10') }}</p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="false" aria-controls="menutwo">{{ trans('politique_quide2') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menutwo" class="collapse">
                                      <div class="card-body">
                                          <p>{{ trans('guide12') }}</p>
                                          <p>{{ trans('guide13') }}</p>
                                          <p>{{ trans('quide14') }}</p>
                                          <p>{{ trans('quide15') }}</p>
                                          <p>{{ trans('quide16') }}</p>
                                          <p>{{ trans('guide17') }}</p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menu3" aria-expanded="false" aria-controls="menu3">{{ trans('politique_quide3') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menu3" class="collapse">
                                      <div class="card-body">
                                          <p>{{ trans('guide21') }}</p>
                                          <p>{{ trans('guide22') }}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menu4" aria-expanded="false" aria-controls="menu4">{{ trans('politique_quide5') }}<span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menu4" class="collapse">
                                      <div class="card-body">
                                          <p>{{ trans('guide33') }}</p>
                                          <p>{{ trans('guide34') }}</p>
                                          <p>{{ trans('guide35') }}</p>
                                          <p>{{ trans('guide36') }}</p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menu5" aria-expanded="false" aria-controls="menu5">{{ trans('politique_quide6') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menu5" class="collapse">
                                      <div class="card-body">
                                          <p>{{ trans('guide41') }}</p>
                                          <p>{{ trans('guide42') }}</p>
                                          <p>{{ trans('guide43') }}</p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menu6" aria-expanded="false" aria-controls="menu6">{{ trans('politique_quide7') }}<span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menu6" class="collapse">
                                      <div class="card-body">
                                          <p>{{ trans('guide51') }}</p>
                                          <p>{{ trans('guide52') }}</p>
                                          <p>{{ trans('guide54') }}</p>
                                          <p>{{ trans('guide55') }}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                </div>


                <div class="row">
                    <div class="col-md-4 ftco-animate">
                      <div class="blog-entry">
                        <div class="text p-4 d-block">
                            <p>{{ trans('politique_quide8') }}</p>
                            <p>{{ trans('guiuide61') }}</p>
                            <p>{{ trans('politique_quide62') }}</p>
                           <br>
                           <br>
                           <br>
                           <br>
                           <br>

                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 ftco-animate">
                      <div class="blog-entry" data-aos-delay="100">

                        <div class="text p-4">
                            <p>{{ trans('politique_quide63') }}</p>
                            <p>{{ trans('politique_quide64') }}</p>
                            <p>{{ trans('politique_quide65') }}</p>
                            <p>{{ trans('politique_quide66') }}</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>




                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 ftco-animate">
                        <div class="blog-entry" data-aos-delay="100">

                          <div class="text p-4">
                              <p>{{ trans('politique_quide67') }}</p>
                              <p>{{ trans('politique_quide68') }}</p>
                              <p>{{ trans('politique_quide69') }}</p>


                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 ftco-animate">
                        <div class="blog-entry" data-aos-delay="100">

                          <div class="text p-4">
                              <p>{{ trans('politique_guide9') }}</p>
                              <p>{{ trans('politique_guide') }}</p>
                              <p>{{ trans('guide91') }}</p>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 ftco-animate">
                        <div class="blog-entry" data-aos-delay="100">

                          <div class="text p-4">
                              <p>{{ trans('guide92') }}</p>
                              <p>{{ trans('guide93') }}</p>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>


                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 ftco-animate">
                        <div class="blog-entry" data-aos-delay="100">

                          <div class="text p-4">
                              <p>{{ trans('guide94') }}</p>
                              <p>{{ trans('guide95') }}</p>
                              <p>{{ trans('') }}</p>

                          </div>
                        </div>
                      </div>



                      <div class="col-md-4 ftco-animate">
                        <div class="blog-entry" data-aos-delay="100">

                          <div class="text p-4">
                              <p>{{ trans('guide96') }}</p>
                              <p>{{ trans('guide97') }}</p>
                              <p>{{ trans('') }}</p>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>

                          </div>
                        </div>
                      </div>



                    <div class="col-md-4 ftco-animate">
                      <div class="blog-entry" data-aos-delay="200">

                        <div class="text p-4">
                            <p>{{ trans('guide98') }}</p>
                              <p>{{ trans('guide99') }}</p>
                              <p>{{ trans('') }}</p>

                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 ftco-animate">
                        <div class="blog-entry" data-aos-delay="200">

                          <div class="text p-4">
                              <p>{{ trans('guide11') }}</p>
                                <p>{{ trans('guide14') }}</p>


                          </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </section
     </div>



@endsection
