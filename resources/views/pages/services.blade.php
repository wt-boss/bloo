@extends('layouts.frontend.app')

@section('content')
    <div class="hero-wrap">
        <div class="overlay"></div>
        <div class="circle-bg"></div>
        <div class="circle-bg-2"></div>
        <div class="container-fluid">
          <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
              <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('service_fil') }}</span></p>
              <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> {{ trans('service_fil') }}</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">{{ trans('service_section_header') }}</span>
            <h2 class="mb-4">{{ trans('service_section_tetle') }}</h2>
            <p>{{ trans('service_section_content') }}</p>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div id="accordion">
    					<div class="row">
    						<div class="col-md-6">
    							<div class="card">
						        <div class="card-header">
										  <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone">{{ trans('service_section_content_question') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
						        </div>
						        <div id="menuone" class="collapse show">
						          <div class="card-body">
												<p>{{ trans('service_section_content1') }}</p>
						          </div>
						        </div>
						      </div>

						      <div class="card">
						        <div class="card-header">
										  <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="false" aria-controls="menutwo">{{ trans('service_section_content_question1') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
						        </div>
						        <div id="menutwo" class="collapse">
						          <div class="card-body">
                                                <p>{{ trans('service_section_content2') }}</p>
                                                <p>{{ trans('service_section_content21') }}</p>
						          </div>
						        </div>
						      </div>


    						</div>

    						<div class="col-md-6">

                                <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menu3" aria-expanded="false" aria-controls="menu3">{{ trans('service_section_content_question3') }}<span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menu3" class="collapse">
                                      <div class="card-body">
                                             <p>{{ trans('service_section_content22') }}</p>
                                             <p>{{ trans('service_section_content23') }}</p>
                                             <p>{{ trans('service_section_content24') }}</p>
                                             <p>{{ trans('service_section_content25') }}</p>
                                             <p>{{ trans('service_section_content26') }}</p>
                                             <p>{{ trans('service_section_content27') }}</p>
                                             <p>{{ trans('service_section_content28') }}</p>

                                      </div>
                                    </div>
                                  </div>

    							<div class="card">
						        <div class="card-header">
										  <a class="card-link" data-toggle="collapse"  href="#menu4" aria-expanded="false" aria-controls="menu4">{{ trans('service_section_content_question4') }} <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
						        </div>
						        <div id="menu4" class="collapse">
						          <div class="card-body">
                                    <p>{{ trans('service_section_content29') }}</p>
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

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">{{ trans('service_section1_header') }}</span>
            <h2 class="mb-4">{{ trans('service_section1_title') }}</h2>
            <p>{{ trans('service_section1_content') }}</p>
            <p>{{ trans('') }}</p>
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
                        <p>{{ trans('service_section1_content1') }}</p>
                        <p>{{ trans('service_section1_content2') }}</p>
                        <p>{{ trans('service_section1_content3') }}</p>

                      </div>
                  </div>
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
            <span class="subheading">{{ trans('service_section2_header') }}</span>
            <h2 class="mb-4">{{ trans('service_section2_title') }}</h2>
            <p>{{ trans('service_sectio11_content') }}</p>
            <p>{{ trans('') }}</p>
          </div>
            </div>
            <div class="row">

          <div class="col-md-12 align-items-center ftco-animate">

            <div class="tab-content ftco-animate" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                  <div class="d-md-flex">

                      <div class="one-half ml-md-5 align-self-center">
                        <p>{{ trans('service_sectio11_content1') }}</p>
                        <p>{{ trans('service_sectio11_content2') }}</p>
                        <p>{{ trans('service_sectio11_content3') }}</p>

                      </div>

                      <div class="one-forth align-self-center">
                        <img src="{{asset('assets/images/dashboard_full_1.jpg') }}" class="img-fluid border" alt="">
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </section>


@endsection
