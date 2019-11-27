@extends('layouts.app')

@section('title')
EBE58 - Actualités
@endsection

@section('content')
<form method="POST" action="{{ url('updateNews') }}" enctype="multipart/form-data">
  @csrf

  <input type="hidden" name="id" value="{{$all -> id}}">

  <label for="name">{{ __('Titre') }}</label>
  <input id="name" type="text" class="inpText" name="name" value="{{$all -> title}}" required autofocus>

  <label for="link">{{ __('Lien') }}</label>
  <input id="link" type="text" class="inpText" name="link" value="{{$all -> link}}" required>

  <label for="image">{{ __('Image') }}</label>
  <input type="file" name="image" class="inpText" id="image">
  <input type="hidden" name="oldImg" value="{{$all -> image}}">
  <img class="margin news-img" src="/news/{{$all -> image}}" alt="{{$all -> title}}">

  <label for="text">{{ __('Texte') }}</label>
  <textarea id="text" class="inpText" name="text" required>{{$all -> text}}</textarea>

  <button type="submit" class="inpBtn">
    {{ __('Modifier la News') }}
  </button>

</form>
<form method="POST" action="{{ url('newsDelete') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{$all -> id}}">

  <button type="submit" class="inpBtn">
    {{ __('Supprimer la News') }}
  </button>
</form>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
