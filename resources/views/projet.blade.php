@extends('default')

@section('title')
EBE58 - {{($projects -> title)}}
@endsection

@section('content')
<section class="project">
	<h1>{{$projects -> title}}</h1>
	<img class="img" src="temp/{{$projects->image}}">
	<p>{{$projects -> description}}</p>
	<h4>{{$projects -> creator}}</h4>
	<a class="inpBtn" href="{{$projects->link}}" onclick="window.open(this.href); return false;">Visiter le site</a>
</section>
@guest
<section class="comment">
	<h4>Si vous voulez laisser un commentaire, créez vous un compte ou connectez-vous !</h4>
</section>
@endguest

@if(Auth::check())
<section class="comment">
	<h5>Commentaires :</h5>
	<form method="POST" action="{{ url('/leaveComment')}}">
		@csrf
		<textarea class="inpText textArea comment" name="comment"></textarea>
		<button type="submit" class="inpBtn btn btn-primary">
			{{ __('Laisser un commentaire') }}
		</button>
	</form>
	@foreach ($comments as $comment)
	<div class="comments">
    <info>
      <img src="@if(!isset($comment->avatar))/img/user.png @else avatar/{{$comment->avatar}} @endif" alt="Logo Cantin" class="icon-user">
      <a>{{$comment->name}}</a>
    </info>
		<p>{{$comment->comments}}</p>
	</div>
	@endforeach
</section>
@endif
@endsection
