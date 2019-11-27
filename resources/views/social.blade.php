@extends('layouts.app')

@section('title')
EBE58 - Social
@endsection

@section('content')

<form method="POST" action="{{ url('addSocial') }}" enctype="multipart/form-data">
  @csrf


  <label for="name">{{ __('Nom') }}</label>
  <input id="name" type="text" class="inpText" name="name" required autofocus>

  <label for="logo">{{ __('Logo') }}</label>
  <div class="rememb">

    <input type="radio" name="remember" value="twitter.png" id="radio-twitter">
    <label class="labelSocial" for="radio-twitter"></label>

    <input type="radio" name="remember" value="facebook.png" id="radio-facebook">
    <label class="labelSocial" for="radio-facebook"></label>

    <input type="radio" name="remember" value="youtube.png" id="radio-youtube">
    <label class="labelSocial" for="radio-youtube"></label>

    <input type="radio" name="remember" value="instagram.png" id="radio-instagram">
    <label class="labelSocial" for="radio-instagram"></label>
  </div>

  <label for="link">{{ __('Lien') }}</label>
  <input id="link" type="text" class="inpText" name="link" required>

  <button type="submit" class="inpBtn">
    {{ __('Ajouter un réseau social') }}
  </button>

</form>

@foreach($socials as $social)
<a class="margin" href="{{$social -> link}}"><img src="/img/{{$social -> logo}}">{{$social -> name}}</a>

<a class="margin" href="/modifySocial?id={{$social -> id}}"><button class="inpBtn">{{__('Modifier')}}</button></a>
@endforeach
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
