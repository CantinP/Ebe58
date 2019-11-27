@extends('layouts.app')

@section('title')
EBE58 - Ajout Produits
@endsection

@section('content')
<form id="addproduct" class="home" method="post" action="{{ url('/addproduct/send')}}" enctype="multipart/form-data">
  @csrf
  <input type="text" name="productName" placeholder="nom du produit" class="inpText" id="productName" onsubmit="return verification()">
  <select name="activities" class="inpText">
    @foreach($section as $results)
    <option value="{{$results -> product}}">{{ $results -> name }}</option>
    @endforeach
  </select>
  <input type="file" name="img" class="inpText">

  <textarea name="productDescription" placeholder="description" id="productDescription"></textarea>

  <input type="text" name="productPrice" placeholder="prix" class="inpText" id="productPrice">{{__('€')}}

  <input type="number" name="productQuantity" placeholder="quantité" class="inpText" id="productQuantity">

  <input type="text" name="productWeight" placeholder="poids" class="inpText" id="productWeight">{{__('kg')}}

  <input type="text" name="productHeight" placeholder="hauteur" class="inpText" id="productHeight">{{__('cm')}}

  <input type="text" name="productWidth" placeholder="largeur" class="inpText" id="productWidth">{{__('cm')}}

  <button class="inpBtn" type="submit" id="add">Ajouter</button>
</form>


@endsection

@section('script')
<script src="{{ asset('/js/verification.js') }}" defer></script>
@endsection
