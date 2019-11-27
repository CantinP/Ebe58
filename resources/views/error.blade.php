@extends('layouts.app')

@section('title')
EBE58 - Erreur
@endsection

@section('content')

<main>
  <h4>Erreur(s) lors de l'étape précédente :</h4>
  <ul class="classic">
    @foreach ($errors as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</main>

@endsection
