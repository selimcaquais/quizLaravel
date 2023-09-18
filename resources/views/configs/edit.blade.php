<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (isset($config))
    <title>EDIT</title>
    @else
    <title>CREATE</title>
    @endif
</head>
<body>
    @if (isset($config))
        <form method="POST" action="{{ route('configs.update', $config) }}" enctype="multipart/form-data" >
        @method('PUT')

    @else

        <form method="POST" action="{{ route('configs.index') }}" enctype="multipart/form-data" >
    @endif
    
    @csrf

        <p>
			<label for="title" >Titre de la question</label><br/>

			<!-- If there is a $config->title, we fill in the input value -->
			<input type="text" name="title" value="{{ isset($config->title) ? $config->title : old('title') }}"  id="title" placeholder="Le titre de la question" >

			<!-- The error message for "title -->
			@error("title")
			<div>{{ $message }}</div>
			@enderror
		</p>
        @if(isset($config))
            @foreach (json_decode($config->possibility) as $key=>$possibility)
                <p>
                    <label for="possibility-{{$key}}" >Réponse {{$key}}</label><br/>
                    <input type="text" name="possibility{{ Str::upper($key)}}" value="{{ isset($possibility) ? $possibility : old('possibility') }}"  id="possibility-{{$key}}" placeholder="Réponse {{$key}}" >

                    @error("possibility")
                    <div>{{ $message }}</div>
                    @enderror
                </p>
            @endforeach
        @else
            <?php $arrayPossibility = ['a','b','c','d'];?>
            @foreach ($arrayPossibility as $key)
                    <p>
                        <label for="possibility-{{$key}}" >Réponse {{$key}}</label><br/>
                        <input type="text" name="possibility{{ Str::upper($key)}}"   id="possibility-{{$key}}" placeholder="Réponse {{$key}}" >

                        @error("possibility")
                        <div>{{ $message }}</div>
                        @enderror
                    </p>
            @endforeach
        @endif
        <p>
			<label for="answer" >Réponse de la question</label><br/>

			<input type="text" name="answer" value="{{ isset($config->answer) ? $config->answer : old('answer') }}"  id="answer" placeholder="Réponse de la question" >
			@error("answer")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<input type="submit" name="valider" value="Valider" >

	</form>

    <a href="{{ route('configs.index')}}">Retour</a>
</body>
</html>