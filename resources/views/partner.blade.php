@extends('layouts.app')

@section('title')
EBE58 - Partenaires
@endsection

@section('content')

@foreach($result as $set)
<section>
  <a href="{{$set -> link}}"><img class="logo" src="/partner/{{$set -> logo}}" alt="logo {{$set -> name}}">
    <article>
      <p>{{$set -> description}}</p>
    </article>
  </a>
</section>
@endforeach

@endsection
