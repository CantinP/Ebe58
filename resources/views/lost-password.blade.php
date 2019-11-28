@extends('layouts.app')

@section('title')
EBE58 - Espace profil
@endsection

@section('content')

<p>Saisissez votre adresse email. Un lien de récupération vous sera envoyé par email.</p>
<form method="post" action="{{ url('oubli')}}">
	@csrf

	<input type="email" class="inpText" name="mail" placeholder="Adresse email">

	<input type="submit" class="inpBtn" name="submit-btn">
</form>

@endsection
