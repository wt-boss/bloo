<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">bloo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="{{Request::is('/home')? "active": ""}}"><a href="{{ route('home') }}" class="nav-link">{{  trans('home_fil')  }}</a></li>
          <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">{{  trans('service_fil')  }}</a></li>
          <li class="nav-item"><a href="{{ route('sondages') }}" class="nav-link">{{  trans('sondage_fil')  }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('prix') }}">{{  trans('prix_fil')  }}</a></li>
          <li class="nav-item"><a href="{{ route('contact_path') }}" class="nav-link">{{  trans('contact_fil')  }}</a></li>
          <li class="nav-item cta"><a href="{{ route('login') }}" class="nav-link"><span>Inscription</span></a></li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->
