@extends('layouts.app')

@section('title')
EBE58 - Administration
@endsection

@section('content')

<div class="backOffice">
  <a href="{{url('texts')}}"><button class="btnBackOffice">{{__('Textes')}}</button></a>
  <a href="{{url('activités-création')}}"><button class="btnBackOffice">{{__('Créer Secteurs')}}</button></a>
  <a href="{{url('activités')}}"><button class="btnBackOffice">{{__('Secteurs')}}</button></a>
  <a href="{{url('partner-modify')}}"><button class="btnBackOffice">{{__('Partenaires')}}</button></a>
  <?php //<a href="{{url('addproduct')}}"><button class="btnBackOffice">{{__('Ajouter un produit')}}</button></a> ?>
  <a class="backBtn" href="{{url('/social')}}"><button class="btnBackOffice">{{__('Ajout de réseaux sociaux')}}</button></a>
  <a class="backBtn" href="{{url('/news-create')}}"><button class="btnBackOffice">{{__('Ajout d\'actu')}}</button></a>
  @if(Auth::user() && Auth::user()->rank === 2)
  <a class="backBtn" href="{{url('/admin')}}"><button class="btnBackOffice">{{__('Modification des droits')}}</button></a>
  @endif
</div>
@endsection
