<?php
//$str = str_replace('watch?v=', 'embed/', $results -> video)
?>

@extends('layouts.app')

@section('title')
EBE58 - Activités
@endsection

@section('content')

<h1>Activités</h1>

@foreach($sectionDisp as $results)
<article class="home activitie">
  <p>{{$results -> name}}</p>
  <p>{{$results -> link}}</p>
  <img class="activities-img" src="/banner/{{$results -> banner}}" alt="bannière activité">
  <img class="banner-activ" src="/logo/{{$results -> logo}}" alt="logo activité">
  <div class="activities-btn"><img src="/button/{{$results -> button}}" alt="bouton activité"></div>
  <p>{{$results -> text}}</p>
  <p>{{$results -> text2}}</p>
  <p>Couleur {{$results -> color}}</p>
  @if($results -> video !== NULL && $results -> video !== "" && $results -> video !== "NULL")
  <div class="video-container">
    <iframe id="mode-cinema" src="{{str_replace('watch?v=', 'embed/', $results -> video)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" alt="video activité" allowfullscreen height="378" width="620"></iframe>
  </div>
  @endif
  <embed src="/pdf/{{$results -> pdf}}" class="pdf activities-img" type='application/pdf'>
  <a class="margin" href="/activités/modify?id={{$results -> id}}">
    <button class="inpBtn">Modifier</button>
  </a>
</article>
@endforeach

@endsection
