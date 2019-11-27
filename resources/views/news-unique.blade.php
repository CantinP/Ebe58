@extends('layouts.app')

@section('title')
EBE58 - News {{$all -> title}}
@endsection

@section('content')
<article class="margin">
  <div class="margin">
    <h2 class="margin">{{$all -> title}}</h2>
    <article>
      <p>{{$all -> text}}</p>
    </article>
    @if($all -> image != NULL)
    <img class="margin news-img" src="/news/{{$all -> image}}">
    @endif
  </div>
</article>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
