@extends('layouts.frontend.app')

@section('content')

    <div class="hero-wrap">
        <div class="overlay"></div>
        <div class="circle-bg"></div>
        <div class="circle-bg-2"></div>
        <div class="container-fluid">
          <div class="slider-text d-md-flex align-items-center" data-scrollax-parent="true">

            <div class="one-forth pr-md-4 ftco-animate align-self-md-center" data-scrollax=" properties: { translateY: '70%' }">
                <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> {{ trans('homme_title') }}  </h1>
              <p class="mb-md-5 mb-sm-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('homme_title_content') }} <br> {{ trans('homme_title_content1') }}</p>
              <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                  <a href="{{route('services')}}" class="btn btn-primary px-4 py-3 bloo-home-btn">{{ trans('homme_title_button') }}</a>
                  <a href="{{route('questionnaire.free')}}" class="btn btn-primary px-4 py-3 bloo-home-btn">{{ trans('btn_home_sondage') }}</a></p>
            </div>
            <div class="one-half align-self-md-end align-self-sm-center">
                <div class="slider-carousel owl-carousel">
                    <div class="item">
                        <img src="{{asset('assets/images/dashboard_full_1.png')}}" class="img-fluid img"alt="">
                    </div>
                    <div class="item">
                        <img src="{{asset('assets/images/dashboard_full_2.png')}}" class="img-fluid img"alt="">
                    </div>
                    <div class="item">
                        <img src="{{asset('assets/images/dashboard_full_3.png')}}" class="img-fluid img"alt="">
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <section class="ftco-section services-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">{{ trans('home_content_section1') }}</span>
                    <br>
                </div>

                <div class="col-md-12 align-items-center ftco-animate">

                    <div class="tab-content ftco-animate" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                            <div class="d-md-flex">
                                <div class="one-half ml-md-5 align-self-center">
                                    <h2 class="mb-4 text-center-global">{{ trans('home_content_section1_title') }}</h2>{{ trans('') }}
                                </div>
                                <div class="one-half ml-md-5 align-self-center">
                                    <p class="text-center-global">
                                        {{ trans('home_content_section1_content') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <div class="row">
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/images/realtime-icons-01.svg') }}" alt="" style="width: 70px; height: 70px;">
                    </div>
                    <div class="media-body p-2 mt-3">
                        <h3 class="heading"> {{ trans('home_content_section1_content_p_title_1') }} </h3>
                        <p>{{ trans('home_content_section1_content_p') }}</p>
                    </div>
              </div>
            </div>
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('assets/images/proximity-icons-02.svg') }}" alt="" style="width: 70px; height: 70px;">
                </div>
                {{-- <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-shield"></span></div></div> --}}
                <div class="media-body p-2 mt-3">
                  <h3 class="heading">{{ trans('home_content_section1_content_p_title_2') }} </h3>
                  <p>{{ trans('home_content_section1_content_p1') }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('assets/images/partners-icons-03.svg') }}" alt="" style="width: 70px; height: 70px;">
                </div>
                {{-- <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-support"></span></div></div> --}}
                <div class="media-body p-2 mt-3">
                  <h3 class="heading">{{ trans('home_content_section1_content_p_title_3') }}</h3>
                  <p>{{ trans('home_content_section1_content_p2') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      @include('layouts.frontend.partial.section_prix')

      <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(assets/images/background_chiffres_bloo.jpg);">
          <div class="container">
              <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2 class="mb-4">{{trans( 'données_tile') }}</h2>
              <span class="subheading">{{ trans('données_tile1') }}</span>
            </div>
          </div>
              <div class="row justify-content-center">
                  <div class="col-md-10">
                      <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="25000">0</strong>
                          <span>{{ trans('données1') }} </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="100">0</strong>
                          <span>{{ trans('données2') }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="218">0</strong>
                          <span>{{ trans('données3') }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="12">0</strong>
                          <span>{{ trans('données4') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          </div>
      </section>

      <section class="ftco-section" >
          <div class="container">
              <div class="row justify-content-center mb-5 pb-5">
                  <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading">{{ trans('home_content_section2') }}</span>
              <h2 class="mb-4">{{ trans('home_content_section2_title') }}</h2>
              <p class="plus">{{ trans('home_content_section2_content') }}</p>
            <p class="plus">
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn1') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn2') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn3') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn5') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn6') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn7') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn9') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn10') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn11') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn12') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn13') }}</button>
                <button type="button" class="btn btn-outline-primary cloud-btn">{{ trans('homme_btn14') }}</button>
            </p>
            </div>
              </div>
              <div class="row">

            <div class="col-md-12 align-items-center ftco-animate">

              <div class="tab-content ftco-animate" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                    <div class="d-md-flex">
                        <div class="one-forth align-self-center">
                            <img src="{{asset('assets/images/img_avantages_bloo_okay.jpg') }}" class="img-fluid border" alt="">
                        </div>
                        <div class="one-half ml-md-5 align-self-center">
                            <h2 class="mb-4">{{ trans('home_content_section2_content2') }}</h2>
                            <p>{{ trans('home_content_section2_content3') }}</p>
                            <p>{{ trans('home_content_section2_content4') }}</p>
                            <p>{{ trans('home_content_section2_content5') }}</p>
                            <p>{{ trans('home_content_section2_content6') }}</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          </div>
      </section>

      <section class="ftco-section-parallax">
          {{-- ggggggggg --}}
        <div class="parallax-img d-flex align-items-center">
          <div class="container">
            <div class="row d-flex justify-content-center">
              <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <h2>{{ trans('home_content_section2_newleter_title') }}</h2>
                <p>{{ trans('home_content_section2_newleter_body') }}</p>
                <div class="row d-flex justify-content-center mt-5">
                  <div class="col-md-6">
                    @if(session('flash'))
                        <p>{{ session('flash') }}</p>
                     @endif
                    <form a action="{{ route('subscribe') }}" method="POST" class="subscribe-form">
                        @csrf
                      <div class="form-group">
                        <input type="email" class="form-control"  name="email" placeholder="{{ trans('home_content_section2_newleter_email') }}">
                            <button type="submit" class="btn btn-link"> <span class="icon icon-paper-plane fa-5x"></span></button>

                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
