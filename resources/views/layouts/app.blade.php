<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Cantin Poiseau and Anaïs Dulieu">
  <meta name="description" content="Site vitrine de l'EBE58">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <link rel="icon" type="image/png" href="img/logo-ebe.png">

  <!-- Scripts -->
  <script src="{{ asset('/js/app.js') }}"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
  @yield('custom_css')
</head>

<body>
  <header>
    <section id="headerLink">
      <div class="top">
        <div class="space">
          <p>Espace :</p>
          @guest
          <a href="{{ url('/ebe58-login') }}">{{ __('Connexion') }}</a>
          @else
          @if (Auth::user() && Auth::user()->rank > 0)
          <a href="{{ url('/administration') }}">{{ __('Administration') }}</a>
          @endif
          @if (Auth::user() && Auth::user()->rank === 0 || Auth::user() && Auth::user()->rank > 0)
          <a href="{{ url('/profil') }}">{{ __('Profil') }}</a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Déconnexion') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          @endif
          @endguest
        </div>
        <?php
//        <form class="form-inline" action="newsletter.php">
//          <input class="form-control mr-sm-2" type="text" placeholder="Newsletter" aria-label="Newsletter">
//          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">S'incrire</button>
//        </form>
        ?>
        <div class="rs">
          @yield('social')
        </div>
      </div>

    </section>
    <div id="headerSlogan">
      <a href="{{url('/')}}"><img src="/img/logo-ebe.png" alt="logo de l'EBE" id="ebeLogo"></a>
      <span>Agir ensemble pour bien vivre !</span>
    </div>
    <nav id="navHeader" class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler nav-link menu-burger" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <div class="burger"></div>
        <div class="burger"></div>
        <div class="burger"></div>
      </button>
      <div class="collapse navbar-collapse text-center" id="navbarText">
        <ul class="navbar-nav mr-auto text-center text-black">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/')}}">{{__('Accueil')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/qui-sommes-nous')}}">{{__('Qui sommes-nous ?')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/actualités')}}">{{__('Archives')}}</a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link" href="{{ url('#') }}">{{ __('Boutique') }}</a>
          </li>
-->
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/contact')}}">{{__('Contact')}}</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <column>
      @yield('content')
    </column>
  </main>
  <hr>
  <footer>
    <div class="space-mobile">
      <p>Espace :</p>
      @guest
      <a href="{{ url('/ebe58-login') }}">{{ __('Connexion') }}</a>
      @else
      @if (Auth::user() && Auth::user()->rank === 2)
      <a href="{{ url('/administration') }}">{{ __('Administration') }}</a>
      @endif
      @if (Auth::user() && Auth::user()->rank === 0 || Auth::user() && Auth::user()->rank > 0)
      <a href="{{ url('/profil') }}">{{ __('Profil') }}</a>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Déconnexion') }}</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @endif
      @endguest
    </div>
    <?php
//    <form class="form-inline-mobile" action="newsletter.php">
//      <input class="form-control mr-sm-2" type="text" placeholder="Newsletter" aria-label="Newsletter">
//      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">S'incrire</button>
//    </form>
    ?>
    <div class="rs-mobile">
      @yield('social')
    </div>
    <section>
      <a href="{{url('/partners')}}">Partenaires</a>
      <a href="{{ url('/mentions')}}">{{__('Mentions Légales')}}</a>
      <a href="{{ url('/crédits')}}">{{__('Crédits')}}</a>
      <p>{{__('©EBE58 2019')}}</p>
    </section>
  </footer>
</body>

@yield('scripts')
