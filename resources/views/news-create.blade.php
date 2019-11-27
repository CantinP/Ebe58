@extends('layouts.app')

@section('title')
EBE58 - Créer une News
@endsection

@section('content')

<form method="POST" action="{{ url('addNews') }}" enctype="multipart/form-data">
  @csrf

  <label for="name">{{ __('Titre') }}</label>
  <input id="name" type="text" class="inpText" name="name" required autofocus>

  <label for="link">{{ __('Lien') }}</label>
  <input id="link" type="text" class="inpText" name="link" required>

  <label for="image">{{ __('Image') }}</label>
  <input type="file" name="image" class="inpText" id="image">

  <label for="text">{{ __('Texte') }}</label>
  <textarea id="text" name="text" required></textarea>

  <button type="submit" class="inpBtn">
    {{ __('Ajouter une news') }}
  </button>

</form>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
