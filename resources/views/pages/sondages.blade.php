@extends('layouts.frontend.app')

@section('content')
    <div class="hero-wrap">
        <div class="overlay"></div>
        <div class="circle-bg"></div>
        <div class="circle-bg-2"></div>
        <div class="container-fluid">
          <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
              <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}"> Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>
              <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('sondage_fil') }}</h1>
            </div>
          </div>
        </div>
      </div>
      <section class="ftco-section bg-light">
          <div class="container">
              <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading">{{ trans('songage_title') }}</span>
              <h2 class="mb-4">{{ trans('sondage_header') }}</h2>
              <p>{{ trans('sondage_content') }}</p>
              <p>{{ trans('sondage_content1') }}</p>
            </div>
          </div>

          </div>
      </section>
      <section class="ftco-section">
          <div class="container">
              <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading">Pricing Plans</span>
              <h2 class="mb-4">Domain Pricing</h2>
            </div>
          </div>
              <div class="row">
                  <div class="col-md-12 ftco-animate">
                      <div class="table-responsive">
                          <table class="table">
                              <thead class="thead-primary">
                                <tr>
                                  <th>Element d'offre</th> '
                                  <th>free</th>
                                  <th>Prenium</th>
                                  <th>Illimité</th>

                                </tr>
                              </thead>
                              <tbody>

                                <tr>
                                  <td>Opération</td>
                                  <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>
                                  <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>
                                  <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>

                                </tr>
                                <tr>
                                    <td>Facturation</td>
                                      <td><span class="collapsed"><i class="icon-remove"></i></span></td>
                                      <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>
                                      <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>


                                  </tr>

                                  <tr>
                                    <td>Opérateur</td>
                                    <td><span class="collapsed"><i class="icon-remove"></i></span></td>
                                    <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>
                                    <td><span class="collapsed"><i class="icon-check-circle"></i></span></td>
                                  </tr>
                                  <tr>
                                      <td>Prix</td>
                                       <td>APD 0 XAF</td>
                                       <td>APD 2.000.000 XAF</td>
                                       <td>APD 40.000.000 XAF</td>
                                  </tr>

                              </tbody>
                            </table>
                        </div>
                  </div>
              </div>
          </div>
      </section>
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
@endsection
