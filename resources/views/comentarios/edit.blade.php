<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar instrumento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    @include('layouts.barraNavegacion')

    <h3>Editar comentario</h3>

    <form action="{{ route('comentarios.update', $comentario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <textarea name="contenido" required maxlength="1000"
            style="width:100%; height:150px;">{{ old('contenido', $comentario->contenido) }}</textarea>

        <button type="submit">Actualizar comentario</button>
    </form>

    <a href="{{ route('instrumentos.show', $comentario->instrumento_id) }}">Cancelar</a>

</body>

</html>