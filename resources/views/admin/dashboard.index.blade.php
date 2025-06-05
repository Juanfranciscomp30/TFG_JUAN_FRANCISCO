<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <<h1>Listado de Instrumentos</h1>

<a href="{{ route('instrumentos.create') }}">Crear nuevo instrumento</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Colores</th>
        <th>Acciones</th>
    </tr>
    @foreach($instrumentos as $instrumento)
        <tr>
            <td>{{ $instrumento->id }}</td>
            <td>{{ $instrumento->tipo }}</td>
            <td>{{ $instrumento->marca }}</td>
            <td>{{ $instrumento->modelo }}</td>
            <td>{{ $instrumento->precio }} €</td>
            <td>{{ $instrumento->stock }}</td>
            <td>{{ $instrumento->colores }}</td>
            <td>
                <a href="{{ route('instrumentos.edit', $instrumento->id) }}">Editar</a> |
                <form action="{{ route('instrumentos.destroy', $instrumento->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</div>
</body>
</html>