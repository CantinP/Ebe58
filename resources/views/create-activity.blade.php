@extends('layouts.app')

@section('title')
EBE58 - Activités
@endsection

@section('content')

<form method="POST" action="{{url('/activités/createSection')}}" enctype="multipart/form-data">
  @csrf

  <label for="name">Nom de l'activité</label>
  <input name="name" class="inpText" id="name" type="text">

  <label for="logo">Logo de l'activité</label>
  <input name="logo" class="inpText" id="logo" type="file">

  <label for="buttonActivity">Bouton d'affichage de l'activité</label>
  <input name="buttonActivity" class="inpText" id="buttonActivity" type="file">

  <label for="link">Lien Boutique (laisser # si aucun)</label>
  <input name="link" class="inpText" id="link" type="text" value="#">

  <label for="banner">Bannière</label>
  <input name="banner" class="inpText" id="banner" type="file">

  <label for="banner">Code Couleur</label>
  <input type="color" id="color" class="margin" value="#000000" name="textcolor">

  <label for="text">Premier bloc</label>
  <textarea name="text" id="text"></textarea>

  <label for="text2">Second bloc</label>
  <textarea name="text2" id="text2"></textarea>

  <label for="video">Video activité (laisser # si aucun)</label>
  <input name="video" id="video" class="inpText" type="text" value="#">

  <label for="pdf">PDF présentation (laisser vide si aucun)</label>
  <input name="pdf" class="inpText" id="pdf" type="file">

  <button class="inpBtn" type="submit">{{__('Ajouter')}}</button>
</form>

@endsection
