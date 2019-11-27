@extends('layouts.app')

@section('title')
EBE58 - Contact
@endsection

@section('content')

<form method="POST" action="{{url('/contact/envoi')}}">
  <h1>Formulaire de Contact</h1>
  @csrf
  <label for="name">{{__('Nom')}}</label>
  <input type="text" name="name" class="inpText" id="name" required autofocus>
  <span class="error" id="error-name"></span>

  <label for="email">{{__('Email')}}</label>
  <input type="email" name="email" class="inpText" id="email" required>
  <span class="error" id="error-mail"></span>

  <label for="subject">{{__('Destinataire')}}</label>
  <select name="receiver" class="inpText" id="receiver" required>
    <option value="none">Sélectionnez un destinataire</option>
    <option value="sav">Question production</option>
    <option value="support">Support Technique</option>
  </select>
  <span class="error" id="error-receiver"></span>

  <label for="subject">{{__('Sujet')}}</label>
  <input type="text" name="subject" class="inpText" id="subject" required>
  <span class="error" id="error-subject"></span>

  <label for="message">{{__('Message')}}</label>
  <textarea name="message" id="message" required></textarea>
  <span class="error" id="error-message"></span>

  <button type="submit" class="inpBtn btn btn-primary">{{__('Envoyer')}}</button>
</form>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/contact.js') }}"></script>
@endsection
