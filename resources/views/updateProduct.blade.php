@extends('layouts.app')

@section('title')
EBE58 - Produits
@endsection

@section('content')
<form id="addproduct" class="home" method="post" action="{{ url('/productlist/product/modify/send')}}" enctype="multipart/form-data">
  @csrf
  <input type="text" class="inpText" name="productName" value="{{$product -> name}}">

  <select name="activities" class="inpText">
    @foreach($section as $results)
    <option value="{{$results -> product}}">{{ $results -> name }}</option>
    @endforeach
  </select>
  <input type="file" class="inpText" name="img">
  <img class="product" src="/product/{{$product -> image}}" alt="image_produit">
  <input type="hidden" class="inpText" name="lastimage" value="{{$product -> image}}">

  <input type="hidden" class="inpText" name="id" value="{{$product -> id}}">
  <p class="textUpdate">Description : </p>
  <textarea name="productDescription">{{$product -> description}}</textarea>
  <p class="textUpdate">Prix : </p>
  <input type="text" class="inpText" name="productPrice" value="{{$product -> price}}">{{__('€')}}
  <p class="textUpdate">Quantité disponible : </p>
  <input type="number" class="inpText" name="productQuantity" value="{{$product -> quantity}}">
  <p class="textUpdate">Poids : </p>
  <input type="text" class="inpText" name="productWeight" value="{{$product -> weight}}">{{__('kg')}}
  <p class="textUpdate">Hauteur : </p>
  <input type="text" class="inpText" name="productHeight" value="{{$product -> height}}">{{__('cm')}}
  <p class="textUpdate">Largeur : </p>
  <input type="text" class="inpText" name="productWidth" value="{{$product -> width}}">{{__('cm')}}

  <button class="inpBtn" type="submit">Modifier</button>
</form>


<form method="POST" action="{{ url('/productlist/product/modify/delete')}}">
  @csrf
  <input type="hidden" name="id" value="{{$product -> id}}">

  <button class="inpBtn" type="submit">Supprimer</button>
</form>

@endsection
