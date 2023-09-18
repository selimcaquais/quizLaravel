<h1>Toutes les questions</h1>

	<p>
		<a href="{{ route('configs.create') }}" >Créer un nouvelle question</a>
	</p>
	<table border="1" >
		<thead>
			<tr>
				<th>Titre</th>
				<th colspan="2" >Opérations</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($configs as $config)
			<tr>
				<td>
					<p>{{ $config->title }}</p>
				</td>
				<td>
					<a href="{{ route('configs.edit', $config) }}" >Modifier</a>
				</td>
				<td>
					<form method="POST" action="{{ route('configs.destroy', $config) }}" >
						<!-- CSRF token -->
						@csrf
						@method("DELETE")
						<input type="submit" value="x Supprimer" >
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<a href="/">retourner au quiz</a>