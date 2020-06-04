<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">BLOO</h2>
            <p>Outils de visualisation et d'analyse des données </p>
            <p class="mt-4"><a href="{{route('register')}}" class="btn btn-primary p-3">{{ trans('footer_btn') }}</a></p>
            <p>{{ trans('change_langue') }} </p>

                {!! link_to('language', session('locale') == 'fr' ? 'English' : 'Français', ['class' => 'btn btn-primary']) !!}


          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">{{ trans('navigation') }}</h2>
            <ul class="list-unstyled">
                <li><a href="{{ route('apropos') }}" class="py-2 d-block">{{ trans('footer_apropos')}}</a></li>
                <li><a href="{{ route('carriere') }}" class="py-2 d-block">{{ trans('footer_career')}}</a></li>

            </ul>
          </div>
        </div>
        <div class="col-md">
           <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">{{ trans('navigation') }}</h2>
            <ul class="list-unstyled">
              <li><a href="{{ route('intimite') }}" class="py-2 d-block">{{ trans('footer_privacy')}}</a></li>
              <li><a href="{{ route('tc') }}" class="py-2 d-block">{{ trans('footer_tc')}}</a></li>


            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View</span></li>

                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">bloo@bloosite.com</span></a></li>

                </ul>
              </div>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p>
             Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | BLOO
          </p>
        </div>
      </div>
    </div>
  </footer>
