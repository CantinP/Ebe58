@extends('layouts.app')

@section('title')
EBE58 - Textes
@endsection

@section('content')

<h2 class="margin">Textes page d'accueil</h2>
@foreach($textsHome as $textHome)
<form method="GET" action="{{url('modificationTextes')}}">
  @csrf
  <input name="id" type="hidden" value="{{$textHome -> id}}">
  <textarea name="text">{{$textHome -> text}}</textarea>
  <button class="inpBtn" type="submit">{{__('Modifier')}}</button>
</form>
@if($textHome -> id != '1')
<form method="POST" action="{{url('deleteTextes')}}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{$textHome -> id}}">

  <button type="submit" class="inpBtn">
    {{ __('Supprimer le texte') }}
  </button>
</form>
@endif
@endforeach
<form method="POST" action="{{url('createTextes')}}">
  @csrf
  <input type="hidden" name="page" value="home">

  <label for="text">{{__('Nouveau Texte')}}</label>
  <textarea name="text" id="text" required></textarea>

  <button class="inpBtn" type="submit">{{__('Ajouter')}}</button>
</form>

<h2 class="margin">Textes page "Qui sommes-nous"</h2>
@foreach($textsQui as $textQui)
<form method="GET" action="{{url('modificationTextes')}}">
  @csrf
  <input name="id" type="hidden" value="{{$textQui -> id}}">
  <textarea name="text">{{$textQui -> text}}</textarea>
  <button class="inpBtn" type="submit">{{__('Modifier')}}</button>
</form>
<form method="POST" action="{{url('deleteTextes')}}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{$textQui -> id}}">

  <button type="submit" class="inpBtn">
    {{ __('Supprimer le texte') }}
  </button>
</form>
@endforeach
<form method="POST" action="{{url('createTextes')}}">
  @csrf
  <input type="hidden" name="page" value="qui">

  <label for="text">{{__('Nouveau Texte')}}</label>
  <textarea name="text" id="text" required></textarea>

  <button class="inpBtn" type="submit">{{__('Ajouter')}}</button>
</form>

<h2 class="margin">Textes page "Crédits"</h2>
@foreach($textsCredits as $textCredits)
<form method="GET" action="{{url('modificationTextes')}}">
  @csrf
  <input name="id" type="hidden" value="{{$textCredits -> id}}">
  <textarea name="text">{{$textCredits -> text}}</textarea>
  <button class="inpBtn" type="submit">{{__('Modifier')}}</button>
</form>
@endforeach

@endsection
