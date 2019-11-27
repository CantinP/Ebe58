@extends('layouts.app')

@section('title')
Création de compte
@endsection

@section('content')
<form method="POST" action="{{ route('register') }}" id="account-creation">
  @csrf

  <label for="name">{{ __('Nom') }}</label>
  <input id="name" type="text" class="inpText form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
  <span class="error" id="error-name"></span>

  <label for="email">{{ __('Adresse mail') }}</label>
  <input id="email" type="email" class="inpText form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
  <span class="error" id="error-mail"></span>

  <label for="password">{{ __('Mot de passe') }}</label>
  <input id="password" type="password" class="inpText form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
  <span class="error" id="error-pw"></span>

  <label for="password-confirm">{{ __('Confirmation mot de passe') }}</label>
  <input id="password-confirm" type="password" class="inpText" name="password_confirmation" required>
  <span class="error" id="error-cpw">Votre mot de passe doit contenir au moins 8 caractères, dont une minuscule, une majuscule, et un chiffre.</span>

  <button type="submit" class="inpBtn" name="submit_btn">
    {{ __("S'enregistrer") }}
  </button>
</form>

<a class="btn btn-link" href="{{ url('/ebe58-login')}}">
  {{ __("J'ai déjà un compte.") }}
</a>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
