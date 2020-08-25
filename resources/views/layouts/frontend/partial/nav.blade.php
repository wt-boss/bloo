<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
        {{-- <img src="{{asset('assets/images/bloo_logo.png')}}" alt="Bloo"> --}}
        <span class="logo"></span>
    </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
           
          <li class="{{Request::is('/')? "active nav-item": "nav-item"}}"><a href="{{ route('home') }}" class="nav-link">{{  trans('home_fil')  }}</a></li>
          <li class="{{Request::is('services')? "active nav-item": "nav-item"}}"><a href="{{ route('services') }}" class="nav-link">{{  trans('service_fil')  }}</a></li>
          <li class="{{Request::is('sondages')? "active nav-item": "nav-item"}}"><a href="{{route('questionnaire.free')}}" class="nav-link">{{  trans('sondage_fil')  }}</a></li>
          <li class="{{Request::is('prix')? "active nav-item": "nav-item"}}"><a class="nav-link" href="{{ route('prix') }}">{{  trans('prix_fil')  }}</a></li>
          <li class="{{Request::is('contact')? "active nav-item": "nav-item"}}"><a href="{{ route('contact_path') }}" class="nav-link">{{  trans('contact_fil')  }}</a></li>
          <li>
            @php $locale = session()->get('locale'); @endphp
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @switch($locale)
                               
                                @case('fr')
                                <i class="icon-globe" style="font-size:19px; color:rgb(255, 255, 255)"></i>&nbspFrançais
                                @break
                                @case('en')
                                <i class="icon-globe" style="font-size:19px; color:rgb(255, 255, 255)"></i>&nbspEnglish
                                @break
                                @case('es')
                                <i class="icon-globe" style="font-size:19px; color:rgb(255, 255, 255)"></i>&nbspEspagnol
                                @break
                                
                                @default
                                <i class="icon-globe" style="font-size:19px; color:rgb(255, 255, 255)"></i>&nbspFrançais
                    @endswitch
                    <span class="caret"></span>
                           
                </a>
               
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('language',session('locale')=='fr')}}">Français</a>
                    <a class="dropdown-item" href="{{ route('language',session('locale')=='en')}} ">English</a>
                    <a class="dropdown-item" href="{{ route('language',session('locale')=='es')}}">Espagnol</a>

                    
                </div>
            </li>

          </li>

            @if (Auth::check())
                <li class="nav-item cta"> <div class="dropdown">
                       <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{Auth::user()->first_name}}   {{Auth::user()->last_name}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('admin') }}">
                                Admin
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div></li>
            @else
                <li class="nav-item cta">
                    <a href="{{ route('login') }}" class="nav-link"><span>Connexion</span></a>
                </li>
            @endif

        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->
