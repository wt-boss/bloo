<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <span class="subheading">{{ trans('prix_title') }}</span>{{ trans('') }}
        <h2 class="mb-4" id="sondage">{{ trans('prix_content') }}</h2>
      </div>
    </div>
        <div class="row">
        <div class="col-md-4">
          <div class="block-7">
            <div class="text-center">
            <h2 class="heading">{{ trans('prix_free') }}</h2>
           {{-- <span class="apd"></span> <span class="number">{{ trans('prix1') }}</span><span class="xaf">XAF</span> </span> --}}<span class="price">
            <span class="excerpt d-block">
              {{ trans('prix_offre_freee') }}
              <br>
              {{ trans('prix_offre_detail') }}
            </span>

            <a href="{{route('questionnaire.free')}}" class="btn btn-primary d-block px-3 py-3 mb-4">{{ trans('prix_btn') }}</a>



            {{-- <h2 class="heading-2 mb-3">{{ trans('prix_introduc') }}</h2> --}}
            <hr>
            <ul class="pricing-text">
              <li><strong>{{ trans('prix_offre_free') }}</strong> </li>
              <hr>

              <li><strong>{{ trans('prix_offre_free1') }}</strong></li>
              <hr>
              <li><strong>{{ trans('prix_offre_free2') }}</strong></li>
              <hr>
              <li><strong>{{ trans('prix_offre_free3') }}</strong></li>
              <hr>
              <li><strong>{{ trans('prix_offre_free4') }}</strong></li>


            </ul>


            </div>
          </div>
        </div>

        <div class="col-md-4">
            <div class="block-7">
              <div class="text-center">
              <h2 class="heading">{{ trans('prix_prenuim') }}</h2>

             {{--  <span class="price"> <span class="apd">ADP</span> <span class="number">{{ trans('prix2') }}</span><span class="xaf">XAF</span> </span> --}}
              <span class="excerpt d-block">{{ trans('prix_offre_prenuim') }}</span>
              <a href="{{route('primus')}}" class="btn btn-primary d-block px-3 py-3 mb-4">{{ trans('prix_btn') }}</a>

              {{-- <h3 class="heading-2 mb-3">{{ trans('prix_introduc') }}</h3> --}}
              <hr>

              <ul class="pricing-text">
                <li><strong>{{ trans('prix_offre_prenuim2') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_prenuim3') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_prenuim4') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_prenuim5') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_prenuim6') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_prenuim7') }}</strong></li>


              </ul>
              </div>
            </div>
        </div>


          <div class="col-md-4">
            <div class="block-7">
              <div class="text-center">
              <h2 class="heading">{{ trans('prix_illimite') }}</h2>

              <span class="excerpt d-block">{{ trans('prix_introduc1') }}</span>
              <a href="{{route('illimité')}}" class="btn btn-primary d-block px-3 py-3 mb-4">{{ trans('prix_btn') }}</a>



              {{-- <h3 class="heading-2 mb-3">{{ trans('prix_introduc') }}</h3> --}}
              <hr>

              <ul class="pricing-text">

                <li><strong>{{ trans('prix_offre_prenuim2') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_prenuim3') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_illimite') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_illimite1') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_llimite2') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_llimite3') }}</strong></li>
                <hr>
                <li><strong>{{ trans('prix_offre_llimite4') }}</strong></li>
              </ul>
              </div>
            </div>
          </div>

      </div>
    </div>
</section>
