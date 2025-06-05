<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumentos Disponibles</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/instrumentos.css') }}">
    
</head>
<body class="body-instrumentos">
    @include('layouts.barraNavegacion')

    <div class="container mt-4">
        <div class="row">
            <!-- Filtro lateral con card y estilos -->
            <div class="col-md-3">
                <div class="filtro-card">
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Instrumento</label>
                        <select id="tipo" class="form-control">
                            <option value="">Selecciona un tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" id="modelo" class="form-control" placeholder="Ej. YTR-2330">
                    </div>
                    <div class="mb-3">
                        <label for="precioMax">Precio máximo:</label>
                        <div id="precioValueBox" class="range-value">1000€</div>
                        <input type="range" id="precioMax" min="0" max="5000" step="500" value="5000" class="custom-range">
                        <div class="range-steps">
                            <span>0€</span>
                            <span>1000€</span>
                            <span>2000€</span>
                            <span>3000€</span>
                            <span>4000€</span>
                            <span>5000€</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row" id="contenedorInstrumentos">
                    @foreach ($instrumentos as $instrumento)
                        <div class="col-md-4 mb-4 instrumento-tarjeta"
                             data-tipo="{{ $instrumento->tipo }}"
                             data-modelo="{{ strtolower($instrumento->modelo) }}"
                             data-precio="{{ $instrumento->precio }}">
                            <div class="card h-100 shadow">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Instrumento">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fa-solid fa-music text-primary"></i>
                                        {{ $instrumento->marca }}
                                    </h5>
                                    <p class="card-text">
                                        <i class="fa-solid fa-guitar text-success"></i>
                                        {{ $instrumento->modelo }}
                                    </p>
                                    <p class="card-text">
                                        <i class="fa-solid fa-euro-sign text-warning"></i>
                                        {{ $instrumento->precio }} €
                                    </p>
                                    <a href="{{ route('instrumentos.show', $instrumento->id) }}" class="btn btn-outline-primary btn-block">
                                        <i class="fa-solid fa-eye"></i> Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($instrumentos->isEmpty())
                    <p>No se encontraron instrumentos</p>
                @endif
            </div>
        </div>
    </div>
    
    @include('layouts.footer')


    <script src="{{ asset('js/instrumentos.js') }}"></script>
</body>
</html>
