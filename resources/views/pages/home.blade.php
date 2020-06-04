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
              <p class="mb-md-5 mb-sm-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('homme_title_content') }}</p>
              <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="{{route('services')}}" class="btn btn-primary px-4 py-3">{{ trans('homme_title_button') }}</a> <a href="{{route('questionnaire.free')}}" class="btn btn-primary px-4 py-3">{{ trans('btn_home_sondage') }}</a></p>
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
                                <h2 class="mb-4">{{ trans('home_content_section1_title') }}</h2>{{ trans('') }}
                              </div>
                              <div class="one-half ml-md-5 align-self-center">
                                <p>
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
                <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-guarantee"></span></div></div>
                <div class="media-body p-2 mt-3">
                  <h3 class="heading"> {{ trans('home_content_section1_content_p_title_1') }} </h3>
                  <p>{{ trans('home_content_section1_content_p') }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-shield"></span></div></div>
                <div class="media-body p-2 mt-3">
                  <h3 class="heading">{{ trans('home_content_section1_content_p_title_2') }} </h3>
                  <p>{{ trans('home_content_section1_content_p1') }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-support"></span></div></div>
                <div class="media-body p-2 mt-3">
                  <h3 class="heading">{{ trans('home_content_section1_content_p_title_3') }}</h3>
                  <p>{{ trans('home_content_section1_content_p2') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

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

      <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(assets/images/bg_1.jpg);">
          <div class="container">
              <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2 class="mb-4">Données traitées</h2>
              <span class="subheading">information sur nos  données</span>
            </div>
          </div>
              <div class="row justify-content-center">
                  <div class="col-md-10">
                      <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="+4000">0</strong>
                          <span>données traitées chaque jour… </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="100">0</strong>
                          <span>questionnaires/jours</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="32000">0</strong>
                          <span>Nombre de  clients</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="31998">0</strong>
                          <span>Nombre d'opérateurs</span>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          </div>
      </section>



      <section class="ftco-section">
          <div class="container">
              <div class="row justify-content-center mb-5 pb-5">
                  <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading">{{ trans('home_content_section2') }}</span>
              <h2 class="mb-4">{{ trans('home_content_section2_title') }}</h2>
              <p>{{ trans('home_content_section2_content') }}</p>
              <p>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn1') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn2') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn3') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn4') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn5') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn6') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn7') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn9') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn10') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn11') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn12') }}</button>
                <button type="button" class="btn btn-outline-primary">{{ trans('homme_btn13') }}</button>




            </p>
            </div>
              </div>
              <div class="row">

            <div class="col-md-12 align-items-center ftco-animate">

              <div class="tab-content ftco-animate" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                    <div class="d-md-flex">
                        <div class="one-forth align-self-center">
                            <img src="{{asset('assets/images/dashboard_full_1.jpg') }}" class="img-fluid border" alt="">
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
        <div class="parallax-img d-flex align-items-center">
          <div class="container">
            <div class="row d-flex justify-content-center">
              <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <h2>{{ trans('home_content_section2_newleter_title') }}</h2>
                <p>{{ trans('home_content_section2_newleter_body') }}</p>
                <div class="row d-flex justify-content-center mt-5">
                  <div class="col-md-6">
                    <form action="#" class="subscribe-form">
                      <div class="form-group">
                        <span class="icon icon-paper-plane"></span>
                        <input type="text" class="form-control" placeholder="{{ trans('home_content_section2_newleter_email') }}">
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
