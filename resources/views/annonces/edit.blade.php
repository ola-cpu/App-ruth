@extends("layouts.app")
@section("title", "Editer une Annonce")
@section("content")

	<h1>Editer une Annonces</h1>

	
	@if (isset($annonce))

	<!-- Le formulaire est géré par la route  -->
	<form method="POST" action="{{ route('annonces.update', $annonce) }}" enctype="multipart/form-data" >

		<!-- <input type="hidden" name="_method" value="PUT"> -->
		@method('PUT')

	@else

	<!-- Le formulaire est géré par la route  -->
	<form method="POST" action="{{ route('annonces.store') }}" enctype="multipart/form-data" >

	@endif

		<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="title" >Titre</label><br/>

			<!-- S'il y a un $annonce->title, on complète la valeur de l'input -->
			<input type="text" name="title" value="{{ isset($annonce->title) ? $annonce->title : old('title') }}"  id="title" placeholder="Le titre de l'annonces" >

			<!-- Le message d'erreur pour "title" -->
			@error("title")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<!-- S'il y a une image $post->picture, on l'affiche -->
		@if(isset($annonce->picture))
		<p>
			<span>Couverture actuelle</span><br/>
			<img src="{{ asset('storage/'.$annonce->picture) }}" alt="image de couverture actuelle" style="max-height: 200px;" >
		</p>
		@endif

		<p>
			<label for="picture" >Photo</label><br/>
			<input type="file" name="picture" id="picture" >

			<!-- Le message d'erreur pour "picture" -->
			@error("picture")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<label for="content" >Contenu</label><br/>

			<!-- S'il y a une annonces->content, on complète la valeur du textarea -->
			<textarea name="content" id="content" lang="fr" rows="10" cols="50" placeholder="Le contenu du post" >{{ isset($annonce->content) ? $post->content : old('content') }}</textarea>

			<!-- Le message d'erreur pour "content" -->
			@error("content")
			<div>{{ $message }}</div>
			@enderror
		</p>

        <p>
			<label for="price" >Prix</label><br/>

			<!-- S'il y a une annonces->content, on complète la valeur du textarea -->
			<input name="price" id="price" lang="fr" rows="10" cols="50" placeholder="Le prix" >{{ isset($annonce->price) ? $post->content : old('content') }}</input>

			<!-- Le message d'erreur pour "content" -->
			@error("price")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<input type="submit" name="valider" value="Valider" >

	</form>

@endsection