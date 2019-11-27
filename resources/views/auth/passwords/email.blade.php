@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
  @csrf
  <label for="email">{{ __('E-Mail Address') }}</label>
  <input id="email" type="email" class="inpText form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

  <button type="submit" class="inpBtn">
      {{ __('Send Password Reset Link') }}
  </button>
</form>
@endsection
