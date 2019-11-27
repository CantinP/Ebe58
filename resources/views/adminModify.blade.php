@extends('layouts.app')

@section('title')
EBE58 - Admin
@endsection

@section('content')
<article>
  <form method="POST" action="{{ url('adminModify') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="id" value="{{$infos -> id}}">

    <label for="name">{{$infos -> name}}</label>

    <label for="rank">{{ __('Rang') }}</label>

    @if($infos -> rank == 2)
    <p class="margin">SuperAdmin</p>
    @endif
    @if($infos -> rank == 1)
    <p class="margin">Équipe</p>
    @endif
    @if($infos -> rank == 0)
    <p class="margin">Client</p>
    @endif

    <input type="hidden" name="oldRank" value="{{$infos -> rank}}">

    <select name="rank" class="inpText">
      <option value="none">{{__('Sélectionnez une option')}}</option>
      <option value="2">
        <p>SuperAdmin</p>
      </option>
      <option value="1">
        <p>Équipe</p>
      </option>
      <option value="0">
        <p>Client</p>
      </option>
    </select>

    <button type="submit" class="inpBtn">
      {{ __('Modifier l\'utilisateur') }}
    </button>

  </form>
  <form method="POST" action="{{ url('adminDelete') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$infos -> id}}">

    <button type="submit" class="inpBtn">
      {{ __('Supprimer l\'utilisateur') }}
    </button>
  </form>
</article>
@endsection

@section('social')
@foreach($socials as $social)
<a href="{{$social -> link}}" onclick="window.open(this.href); return false;"><img src="/img/{{$social -> logo}}"></a>
@endforeach
@endsection
