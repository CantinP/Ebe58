@extends('layouts.app')

@section('title')
EBE58 - Qui Sommes Nous ?
@endsection

@section('content')
<section>
  <h1>Présentation de l'entreprise EBE58, et de son organisation.</h1>
</section>
@foreach($textsQui as $textQui)
<p>{{$textQui -> text}}</p>
@endforeach
@endsection
