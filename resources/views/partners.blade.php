@extends('layouts.app')

@section('title')
EBE58 - Partenaires
@endsection

@section('content')

<form class="home" method="POST" action="{{url('/partenaires/create')}}" enctype="multipart/form-data">
  @csrf

  <label for="name">Nom du partenaire</label>
  <input name="name" class="inpText" id="name" type="text">

  <label for="link">Lien</label>
  <input name="link" class="inpText" id="link" type="text">

  <label for="logo">Logo</label>
  <input name="logo" class="inpText" id="logo" type="file">

  <label for="description">Description</label>
  <textarea name="description" id="description"></textarea>

  <button class="inpBtn" type="submit">{{__('Valider')}}</button>
</form>
@foreach($result as $set)
<article class="home">
  <p>{{$set -> name}}</p>
  <p>{{$set -> link}}</p>
  <img src="/partner/{{$set -> logo}}" alt="logo {{$set -> name}}">
  <p>{{$set -> description}}</p>
  <a href="/partenaires/modify?id={{$set -> id}}"><button class="inpBtn">{{__('Modifier')}}</button></a>
</article>
@endforeach

@endsection
