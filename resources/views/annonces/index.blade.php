@extends("layouts.app")
@section("title", "Tous les annonces")
@section("content")

	<h1>Tous les annonces</h1>

	<p>
		<!-- Lien pour créer une annonces-->
		<a href="{{ route('annonces.create') }}" title="Créer une annonces" >Créer une annonces</a>
	</p>

	<!-- Le tableau pour lister les annonces -->
	<table border="1" >
		<thead>
			<tr>
				<th>Titre</th>
				<th colspan="2" >Opérations</th>
			</tr>
		</thead>
		<tbody>
			<!-- On parcourt la collection d annonces -->
			@foreach ($annonce as $annonc)
			<tr>
				<td>
					<!-- Lien pour afficher une annonces -->
					<a href="{{ route('annonces.show', $annonce) }}" title="Lire l annonces" >{{ $annonc->title }}</a>
				</td>
				<td>
					<!-- Lien pour modifier une annonces  -->
					<a href="{{ route('posts.edit', $annonce) }}" title="Modifier l'annonces" >Modifier</a>
				</td>
				<td>
					<!-- Formulaire pour supprimer une annonces -->
					<form method="POST" action="{{ route('annonces.destroy', $annonce) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
						<input type="submit" value="x Supprimer" >
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
@endsection