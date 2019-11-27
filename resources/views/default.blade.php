<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Cantin Poiseau">
  <meta name="description" content="Site portfolio et passerelle de Cantin poiseau">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<link rel="icon" type="image/png" href="{{ asset('/img/logoC.png') }}">
	@yield('custom_css')
	<link rel="stylesheet" href="{{ asset('/css/app.css') }}" type="text/css">
	<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
	<header class="header-content">
		<li class="nav-item dropdown">
			<a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><img src="{{ url('/img/profil.png') }}" alt="Logo Profil" class="icon-user"></a>

			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="{{ route('cv') }}">
					{{ __('CV') }}
				</a>
				<a class="dropdown-item" href="{{ route('contact') }}">
					{{ __('Contact') }}
				</a>
			</div>
		</li>

		<a class="icon-header" href="{{ url('/') }}"><img src="{{ url('/img/logoC.png') }}" alt="Logo Cantin" class="icon-header"></a>
		@guest
		<a href="{{ url('/login') }}"><img src="@if(!isset($avatar))/img/user.png @else avatar/{{$avatar}} @endif" alt="Logo Cantin" class="icon-user"></a>
		@else
		<li class="nav-item dropdown">
			<a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><img src="@if(!isset($avatar))/img/user.png @else avatar/{{$avatar}} @endif" alt="Logo User" class="icon-user"></a>

			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item">{{ Auth::user()->name }}</a>
				<a class=" dropdown-item" href="{{ route('profil') }}">
					{{ __('Profil') }}
				</a>
				@if(Auth::check() && Auth::user()->vip === 1)
				<a class="dropdown-item" href="{{url('/backoffice')}}">{{ __('BackOffice') }}</a>
				@endif
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
																	 document.getElementById('logout-form').submit();">
					{{ __('Déconnexion') }}
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</li>
		@endguest
	</header>

	<main>
		@yield('content')
	</main>

	<footer>
	</footer>

	@yield('scripts')

</body>

</html>
