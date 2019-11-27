@extends('layouts.app')

@section('title')
EBE58 - Modification Partenaires
@endsection

@section('content')

<form class="home" method="POST" action="{{url('/partenaires/modify/send')}}" enctype="multipart/form-data">
  @csrf

  <input name="id" type="hidden" value="{{$result -> id}}">

  <label for="name">Nom du partenaire</label>
  <input name="name" class="inpText" id="name" type="text" value="{{$result -> name}}">

  <label for="link">Lien</label>
  <input name="link" class="inpText" id="link" type="text" value="{{$result -> link}}">

  <label for="logo">Logo</label>
  <input name="logo" class="inpText" id="logo" type="file">
  <input name="logoancient" type="hidden" value="{{$result -> logo}}">
  <img src="/partner/{{$result -> logo}}" class="logo margin" alt="bannière activité">

  <label for="description">Description</label>
  <textarea name="description" id="description">{{$result -> description}}</textarea>

  <button class="inpBtn" type="submit">{{__('Valider')}}</button>
</form>
<form method="POST" action="{{url('/partenaires/modify/delete')}}">
  @csrf
  <input name="id" type="hidden" value="{{$result -> id}}">
  <button class="inpBtn" type="submit">{{__('Supprimer')}}</button>
</form>

@endsection
