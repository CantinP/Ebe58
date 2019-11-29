@extends('layouts.app')

@section('title')
EBE58 - Accueil
@endsection

@section('content')

<section>
  <sidebar class="col-">
    <h3 class="sidebar-title">Quoi de neuf ?</h3>
    @if(!empty($newsHome))
    @foreach($newsHome as $resulting)
    <article>
      <h4 class="sidebar-title">{{$resulting -> title}}</h4>
      <p id="container{{($resulting -> id)}}">{{($resulting -> text)}}</p>
      <a href="{{$resulting -> link}}">
        Pour en voir plus.
      </a>
      @if($resulting -> image != NULL)
      <img class="margin banner-news" src="/news/{{$resulting -> image}}">
      @endif
    </article>
    @endforeach
    @else
    <h4>Pas d'actualité pour le moment !</h4>
    @endif
  </sidebar>
  <div class="col-lg top column">
    <article class="margin desktop">
      <h3>{{$texts[2]}}</h3>
      <div class="edito">
        @foreach($textsHome as $textHome)
        @if($textHome -> id != '1')
        <p>{{$textHome -> text}}</p>
        @endif
        @endforeach
      </div>
    </article>
    <h5>Secteurs d'activités</h5>
    <div class="row">
      @foreach($sectionDisp as $result)
      <a class="activities-btn" href="/section?id={{$result ->id}}">
        <img src="/button/{{$result -> button}}" alt="{{$result -> name}}">
        <p style="background-color : {{$result -> color}};">{{$result -> name}}</p>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
