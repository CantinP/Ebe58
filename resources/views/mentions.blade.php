@extends('layouts.app')

@section('title')
EBE58 - Mentions Légales
@endsection

@section('content')
<article class="comment margin">
  <h1 class="margin">Mentions légales</h1>
  <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site http://www.ebe58.fr l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi :</p>
  <br>
  <p>Propriétaire:<br>
    EBE58
  </p>
  <p>
    Concepteur: <br>
    Créateur site internet : Cantin Poiseau<br>
    Site internet : https://www.cantin-poiseau.fr
  </p>
  <p>
    Responsable publication :<br>
    Le responsable publication est une personne physique ou une personne morale.
  </p>
  <p>
    Hébergeur :<br>
    OVH<br>
    SASU au capital de 10 174 560,00 €<br>
    RCS Lille Métropole 424 761 419 00045<br>
    Code APE 6202A<br>
    N° TVA : FR 22 424 761 419<br>
    Siège social : 2 rue Kellermann - 59100 Roubaix - France<br>
  </p>
</article>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
