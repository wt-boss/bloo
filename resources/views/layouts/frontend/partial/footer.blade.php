<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
            <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">{{ trans('Langue') }}</h2>
                {{-- <p>Outils de visualisation et d'analyse des données </p>
                <p>{{ trans('change_langue') }} </p> --}}
                {!! link_to('language', session('locale') == 'fr' ? 'English' : 'Français', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        <div class="col-md">
            <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">{{ trans('navigation') }}</h2>
                <ul class="list-unstyled">
                    <li class="{{Request::is('home')? "active": "nav-item"}}"><a class="py-2 d-block" href="{{ route('home') }}">{{  trans('home_fil')  }}</a></li>
                    <li class="{{Request::is('services')? "active": "nav-item"}}"><a class="py-2 d-block" href="{{ route('services') }}">{{  trans('service_fil')  }}</a></li>
                    <li class="{{Request::is('sondages')? "active": "nav-item"}}"><a class="py-2 d-block" href="{{route('questionnaire.free')}}">{{  trans('sondage_fil')  }}</a></li>
                    <li class="{{Request::is('prix')? "active": "nav-item"}}"><a class="py-2 d-block" href="{{ route('prix') }}">{{  trans('prix_fil')  }}</a></li>
                </ul>
           </div>
         </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">{{ trans('lien') }}</h2>
            <ul class="list-unstyled">
                <li><a href="{{ route('apropos') }}" class="py-2 d-block">{{ trans('footer_apropos')}}</a></li>
                <li><a href="{{ route('carriere') }}" class="py-2 d-block">{{ trans('footer_career')}}</a></li>
                <li><a href="{{ route('Politique_de_confidentialité') }}" class="py-2 d-block">{{ trans('footer_privacy')}}</a></li>
                <li><a href="{{ route('Termes_&_Conditions') }}" class="py-2 d-block">{{ trans('footer_tc')}}</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-envelope"></span><span class="text">hello@blooapp.live</span></li>
                </ul>
              </div>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-linkedin"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-youtube"></span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>

            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Bloo. All rights reserved<strong>
          </p>
        </div>
      </div>
    </div>
  </footer>
