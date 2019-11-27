@extends('layouts.app')

@section('title')
EBE58 - Textes
@endsection

@section('content')

<h2 class="margin">Textes page d'accueil</h2>
@foreach($textsHome as $textHome)
<form method="GET" action="{{url('modificationTextes')}}">
  @csrf
  <input name="title" type="hidden" value="{{$textHome -> title}}">
  <textarea name="text">{{$textHome -> text}}</textarea>
  <button class="inpBtn" type="submit">{{__('Modifier')}}</button>
</form>
@endforeach

<h2 class="margin">Textes page "Qui sommes-nous"</h2>
@foreach($textsQui as $textQui)
<form method="GET" action="{{url('modificationTextes')}}">
  @csrf
  <input name="title" type="hidden" value="{{$textQui -> title}}">
  <textarea name="text">{{$textQui -> text}}</textarea>
  <button class="inpBtn" type="submit">{{__('Modifier')}}</button>
</form>
@endforeach

<h2 class="margin">Textes page "Crédits"</h2>
@foreach($textsCredits as $textCredits)
<form method="GET" action="{{url('modificationTextes')}}">
  @csrf
  <input name="title" type="hidden" value="{{$textCredits -> title}}">
  <textarea name="text">{{$textCredits -> text}}</textarea>
  <button class="inpBtn" type="submit">{{__('Modifier')}}</button>
</form>
@endforeach

@endsection
