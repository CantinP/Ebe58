@extends('default')

@section('title')
EBE58 - Profil
@endsection

@section('content')
<article>

	<form method="POST" action="{{ url('updatePfl') }}" enctype="multipart/form-data">
		<img src="@if(!isset($avatar))/img/user.png @else avatar/{{$avatar}} @endif" alt="Logo Cantin" class="icon-log">
		@csrf

		<label for="email">{{ __('Adresse mail') }}</label>
		<input id="email" type="email" class="inpText form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$mail}}" required autofocus>
    <span class="error" id="error-mail"></span>

		<label for="name">{{ __('Nom') }}</label>
		<input id="name" type="name" class="inpText form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$name}}" required>
    <span class="error" id="error-name"></span>

		<label for="image">{{__('Avatar')}}</label>
		<input name="image" type="file" class="inpText">
		<input name="img" type="hidden" value="{{$avatar}}">

		<button type="submit" name="submit-btn" class="inpBtn btn btn-primary">
			{{ __('Changer mes informations') }}
		</button>

	</form>
	<form method="POST" action="{{ url('/updatePsw')}}">
    @csrf
    <input type="hidden" name="email" value="{{$mail}}">

		<label for="password">{{ __('Mot de passe') }}</label>
		<input id="password" type="password" class="inpText form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    <span class="error" id="error-pw"></span>

		<label for="npassword">{{ __('Nouveau Mot de passe') }}</label>
		<input id="npassword" type="password" class="inpText form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="npassword" required>
    <span class="error" id="error-npw"></span>

		<label for="cpassword">{{ __(' Confirmer le Mot de passe') }}</label>
		<input id="cpassword" type="password" class="inpText form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="cpassword" required>
    <span class="error" id="error-cpw"></span>

		<button type="submit" name="submit-btn" class="inpBtn btn btn-primary">
			{{ __('Changer mon mot de passe') }}
		</button>

	</form> 


</article>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/profil.js') }}"></script>
@endsection
