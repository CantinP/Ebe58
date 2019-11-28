@extends('layouts.app')

@section('title')
EBE58 - Espace profil
@endsection

@section('content')

<form method="post" action="{{ url('/changep')}}" id="change-pass">
	@csrf

	<input type="hidden" name="link" value="{{$link}}">

	<input type="password" class="inpText" name="password" placeholder="Mot de passe">
	<span id="error-pw"></span>

	<input type="password" class="inpText" name="confirm-password" placeholder="Confirmer mot de passe">
	<span id="error-cpw"></span>

	<input class="inpBtn" type="submit" name="submit-btn" value="modifier le mot de passe">
</form>

@endsection
