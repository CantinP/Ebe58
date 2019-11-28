@extends('layouts.app')

@section('title')
Connexion
@endsection

@section('content')
<form method="POST" action="{{ route('login') }}">
	@csrf

	<label for="email">{{ __('Adresse mail') }}</label>

	<input id="email" type="email" class="inpText form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

	@if ($errors->has('email'))
	<span class="invalid-feedback" role="alert">
		<strong>{{ $errors->first('email') }}</strong>
	</span>
	@endif

	<label for="password">{{ __('Mot de passe') }}</label>

	<input id="password" type="password" class="inpText form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

	@if ($errors->has('password'))
	<span class="invalid-feedback" role="alert">
		<strong>{{ $errors->first('password') }}</strong>
	</span>
	@endif
	<div class="remember">
		<input type="checkbox" name="remember" id="radio-oui" {{ old('remember') ? 'checked' : '' }}>
		<label class="label" for="radio-oui"></label>

		<label class="checkbox">
			{{ __('Se souvenir de moi') }}
		</label>
	</div>

	<button type="submit" class="inpBtn btn btn-primary">
		{{ __('Se connecter') }}
	</button>
	<?php
//	@if (Route::has('password.request'))
//	<a href="{{ route('password.request') }}">
//		{{ __('Mot de passe perdu ?') }}
//	</a>
//	@endif
  ?>
	<a href="{{ url('/ebe58-register')}}">Pas de compte ?</a>
	<a href="{{ url('/oubli')}}">Mot de passe perdu</a>
</form>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
