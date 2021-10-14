@extends("layouts.app")
@section("title", $annonce->title)
@section("content")

	<h1>{{ $annonce->title }}</h1>

	<img src="{{ asset('storage/'.$annonce->picture) }}" alt="Image de couverture" style="max-width: 300px;">

	<div>{{ $annonce->content }}</div>

    <h3>{{ $annonce->price }}</h3>

	<p><a href="{{ route('annonces.index') }}" title="Retourner aux  annonces" >Retourner aux annonces</a></p>

@endsection