@extends('layouts.app')

@section('title')
EBE58 - Espace profil
@endsection

@section('content')

<h2>Bonjour, <span>{{$title}}</span></h2>

<form id="profile-form" method="post" action="{{ url('updateProfil') }}">
  @csrf

  <span class="confirmations" id="confirmation-profile"></span>

  <label for="name">{{__('Votre nom')}}</label>
  <input id="name" class="inpText" type="text" name="name" value="{{ $name }}">
  <span class="errors" id="error-name"></span>

  <label for="email">{{__('Votre adresse mail')}}</label>
  <input id="email" class="inpText" type="email" name="email" value="{{ $email }}">
  <span class="errors" id="error-mail"></span>

  @if (Auth::user() && Auth::user()->rank === 0)

  <label for="address">{{__('Votre adresse')}}</label>
  <input id="address" class="inpText" type="text" name="address" value="{{ $address }}">
  <span class="errors" id="error-address"></span>

  <label for="zip">{{__('Votre code postal')}}</label>
  <input id="zip" class="inpText" type="text" name="zip" value="{{ $zip }}">
  <span class="errors" id="error-zip"></span>

  <label for="city">{{__('Votre commune')}}</label>
  <input id="city" class="inpText" type="text" name="city" value="{{ $city }}">
  <span class="errors" id="error-city"></span>

  @endif
  @if (Auth::user() && Auth::user()->rank === 1)

  <p>Vous faites partit de l'équipe EBE58.</p>

  @endif

  <input type="submit" class="inpBtn" name="submit-btn">
</form>

<form method="post" action="{{ url('changePsw')}}">
  @csrf

  <input type="password" class="inpText" id="password" name="password" placeholder="Mot de passe">
  <span class="errors" id="error-pw"></span>

  <input type="password" class="inpText" name="new-password" placeholder="Nouveau mot de passe">
  <span class="errors" id="error-npw"></span>

  <input type="password" class="inpText" name="confirm-password" placeholder="Confirmer mot de passe">
  <span class="errors" id="error-cpw"></span>

  <input type="submit" class="inpBtn" name="submit-btn">
</form>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/profile.js') }}"></script>
@endsection
