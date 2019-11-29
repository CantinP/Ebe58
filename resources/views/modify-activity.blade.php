@extends('layouts.app')

@section('title')
EBE58 - Modification Secteur
@endsection

@section('content')

<form class="home" method="POST" action="{{url('/activités/modify/send')}}" enctype="multipart/form-data">
  @csrf

  <input name="id" type="hidden" value="{{$result -> id}}">

  <label for="name">Nom de l'activité</label>
  <input name="name" class="inpText" id="name" type="text" value="{{$result -> name}}">

  <label for="logo">Logo de l'activité</label>
  <input name="logo" class="inpText" id="logo" type="file">
  <input name="logoancient" type="hidden" value="{{$result -> logo}}">
  <img class="banner-activ" src="/logo/{{$result -> logo}}" alt="logo activité">

  <label for="buttonActivity">Bouton d'affichage de l'activité</label>
  <input name="buttonActivity" class="inpText" id="buttonActivity" type="file">
  <input name="buttonancient" type="hidden" value="{{$result -> button}}">
  <div class="activities-btn"><img src="/button/{{$result -> button}}" alt="bouton activité"></div>

  <label for="link">Lien Boutique</label>
  <input name="link" class="inpText" id="link" type="text" value="{{$result -> link}}">

  <label for="banner">Bannière</label>
  <input name="banner" class="inpText" id="banner" type="file">
  <input name="bannerancient" type="hidden" value="{{$result -> banner}}">
  <img class="activities-img" src="/banner/{{$result -> banner}}" alt="bannière activité">

  <label for="color">Code Couleur</label>
  <input id="color" class="margin" type="color" value="{{$result -> color}}" name="color">

  <label for="text">Adresse</label>
  <textarea name="text" id="text">{{$result -> text}}</textarea>

  <label for="text2">Numéro</label>
  <textarea name="text2" id="text2">{{$result -> text2}}</textarea>

  <label for="text3">Horaires</label>
  <textarea name="text3" id="text3">{{$result -> text3}}</textarea>

  <label for="text4">Description</label>
  <textarea name="text4" id="text4">{{$result -> text4}}</textarea>

  <label for="video">Lien Vidéo</label>
  <input name="video" class="inpText" id="video" type="text" value="{{$result -> video}}">

  <label for="pdf">PDF présentation</label>
  <input name="pdf" class="inpText" id="pdf" type="file">
  <input name="pdfancient" type="hidden" value="{{$result -> pdf}}">
  <embed src="/pdf/{{$result -> pdf}}" class="pdf" type='application/pdf'>

  <button class="inpBtn" type="submit">{{__('Valider')}}</button>
</form>
<form method="POST" action="{{url('/activités/modify/delete')}}">
  @csrf
  <input name="id" type="hidden" value="{{$result -> id}}">
  <button class="inpBtn" type="submit">{{__('Supprimer')}}</button>
</form>

@endsection
