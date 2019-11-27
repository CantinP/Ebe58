@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
@csrf

<input type="hidden" name="token" value="{{ $token }}">
<label for="email">{{ __('E-Mail Address') }}</label>
<input id="email" type="email" class="inpText form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

<label for="password">{{ __('Password') }}</label>
<input id="password" type="password" class="inpText form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

<label for="password-confirm">{{ __('Confirm Password') }}</label>
<input id="password-confirm" type="password" class="inpText" name="password_confirmation" required>

<button type="submit" class="inpBtn">
    {{ __('Reset Password') }}
</button>
</form>
@endsection
