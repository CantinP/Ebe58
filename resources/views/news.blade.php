@extends('layouts.app')

@section('title')
EBE58 - News
@endsection

@section('content')
<article class="margin">
  @if(!empty($newsHome))
  @foreach($newsHome as $resulting)
  <a href="/actualité?id={{$resulting -> id}}">
    <article>
      <div class="margin">
        <h4 class="sidebar-title">{{$resulting -> title}}</h4>
        <p>{{substr($resulting -> text, 0 , 100) . '...'}}</p>
        @if($resulting -> image != NULL)
        <img class="margin banner-news" src="/news/{{$resulting -> image}}">
        @endif
        @if(Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank > 1)
        <a class="margin" href="/modifyNews?id={{$resulting -> id}}"><button class="inpBtn">{{__('Modifier')}}</button></a>
        @endif
      </div>
    </article>
  </a>
  @endforeach
  @else

  <h2>Pas d'actualité en ce moment !</h2>

  @endif
</article>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
