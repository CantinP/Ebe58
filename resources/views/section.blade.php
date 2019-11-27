@extends('layouts.app')

@section('title')
EBE58 - Secteur d'Activités
@endsection

@section('content')

<section>
  <sidebar class="col-">
    <h3 class="sidebar-title">Secteurs d'activités</h3>
    @foreach($sectionDisp as $resulting)
    @if($result -> id != $resulting -> id)
    <article>
      <a class="activities-sidebar" href="/section?id={{$resulting ->id}}">
        {{$resulting -> name}}
      </a>
    </article>
    @else

    @endif
    @endforeach
  </sidebar>
  <div class="col-lg top column">
    <img class="banner-activ" src="/logo/{{$result -> logo}}" alt="logo activité">
    <row>
      <p>{{$result -> text}}</p>
      <img class="activities-img" src="/banner/{{$result -> banner}}" alt="bannière activité">
    </row>
    @if($result -> video !== NULL && $result -> video !== "" && $result -> video !== "NULL")
    <div class="video-container">
      <iframe id="mode-cinema" src="{{str_replace('watch?v=', 'embed/', $result -> video)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" alt="video activité" allowfullscreen height="378" width="620"></iframe>
    </div>
    @endif
    <p>{{$result -> text2}}</p>
    <a class="margin" href="{{$result -> link}}"><button class="inpBtn">Visiter la Boutique</button></a>
    <a class="download margin" href="/pdf/{{$result -> pdf}}">
      <img class='logo' src="/img/download.png">
    </a>
  </div>
</section>

@endsection
