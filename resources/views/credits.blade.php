@extends('layouts.app')

@section('title')
EBE58 - Crédits
@endsection

@section('content')
<section>
  <h1>Crédits.</h1>
</section>
<h2>Design PC</h2>
<p>{{$texts[0]}}</p>
<h2>Design Mobile</h2>
<p>{{$texts[1]}}</p>
<h2>Développement et Intégration</h2>
<p>{{$texts[2]}}</p>
<h2>Gestion Site</h2>
<p>{{$texts[3]}}</p>
@endsection
