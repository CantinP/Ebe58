@extends('layouts.app')

@section('title')
EBE58 - Admin
@endsection

@section('content')
@foreach($admins as $result)
<set>
  <h3>{{$result -> name}}</h3>
  @if($result -> rank == 2)
  <p>SuperAdmin</p>
  @endif
  @if($result -> rank == 1)
  <p>Équipe</p>
  <a class="margin" href="/modifyAdmin?id={{$result -> id}}"><button class="inpBtn">{{__('Modifier')}}</button></a>
  @endif
  @if($result -> rank == 0)
  <p>Client</p>
  <a class="margin" href="/modifyAdmin?id={{$result -> id}}"><button class="inpBtn">{{__('Modifier')}}</button></a>
  @endif
</set>
@endforeach
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
