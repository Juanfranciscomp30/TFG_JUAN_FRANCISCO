<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del instrumento</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/SonArte.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/showInstrumentos.css') }}">

</head>

<body>
    @include('layouts.barraNavegacion')

    <div id="alertaCarrito" class="alert alert-success text-center"
        style="display:none; position:fixed; top:10px; left:50%; transform:translateX(-50%); z-index:9999;">
        <i class="fa-solid fa-circle-check"></i> Producto añadido al carrito
    </div>

    <div class="instrumento-detalle">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                    <img src="/{{ $instrumento->foto }}" alt="Instrumento" class="img-instrumento" w-100"
                        style="max-width:320px;">
                </div>
                <div class="col-12 col-md-6">
                    <h1>{{ $instrumento->marca }} - {{ $instrumento->modelo }}</h1>
                    <p><strong><i class="fa-solid fa-tag"></i> Precio:</strong> €{{ $instrumento->precio }}</p>
                    <p><strong><i class="fa-solid fa-music"></i> Tipo:</strong> {{ $instrumento->tipo }}</p>

                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="instrumento_id" value="{{ $instrumento->id }}">

                        <p><strong><i class="fa-solid fa-palette"></i> Colores disponibles:</strong></p>
                        @php
                            $colores = explode(',', $instrumento->colores);
                        @endphp

                        <div class="selector-colores mb-2">
                            @foreach ($colores as $index => $color)
                                <input type="radio" name="color" id="color_{{ $index }}" value="{{ trim($color) }}"
                                    required>
                                <label for="color_{{ $index }}" class="color-circle-label" title="{{ trim($color) }}">
                                    <span class="color-circle" style="background: {{ strtolower(trim($color)) }};"></span>
                                    <span class="color-nombre">{{ ucfirst(trim($color)) }}</span>
                                </label>
                            @endforeach
                        </div>

                        <p class="mt-3"><strong><i class="fa-solid fa-boxes-stacked"></i> Stock disponible:</strong>
                            {{ $instrumento->stock }} unidades</p>

                        @if($instrumento->stock > 0)
                            @if(auth()->check())
                                <button type="submit" onclick="mostrarAlertaCarrito()" class="btn btn-secondary mt-3">
                                    <i class="fa-solid fa-cart-plus"></i> Añadir al carrito
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary mt-3" data-toggle="modal"
                                    data-target="#loginRequeridoModal">
                                    <i class="fa-solid fa-cart-plus"></i> Añadir al carrito
                                </button>
                            @endif
                        @else
                            <button type="button" class="btn btn-secondary mt-3" disabled>
                                <i class="fa-solid fa-cart-plus"></i> Sin stock
                            </button>
                        @endif
                        <p class="text-muted mt-2">Stock disponible: {{ $instrumento->stock }}</p>
                    </form>
                </div>
            </div>

            <div class="descripcion">
                <h3><i class="fa-solid fa-info-circle"></i> Descripción</h3>
                <p>Este instrumento es perfecto para músicos de todos los niveles. Con un diseño único y materiales de
                    alta calidad, te proporcionará una experiencia sonora increíble.</p>
            </div>

            <div class="comentarios container my-4">
                <h3 class="mb-3"><i class="fa-solid fa-comments"></i> Comentarios</h3>

                @if(auth()->check())
                    <form action="{{ route('comentarios.store', $instrumento->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="instrumento_id" value="{{ $instrumento->id }}">

                        <div class="form-group">
                            <textarea class="form-control" name="contenido" required maxlength="1000" rows="3"
                                placeholder="Escribe aquí tu comentario..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i> Añadir comentario
                        </button>
                    </form>
                @else
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginRequeridoModal">
                        <i class="fa-solid fa-plus"></i> Añadir comentario
                    </button>
                @endif

                <hr>

                <ul class="list-group mt-4">
                    @foreach ($instrumento->comentarios as $comentario)
                        <li class="list-group-item">
                            <strong><i class="fa-solid fa-user"></i> {{ $comentario->user->name }}:</strong>
                            {{ $comentario->contenido }}

                            @if (auth()->id() === $comentario->user_id)
                                <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST"
                                    class="float-right ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que quieres eliminar este comentario?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                                <button type="button" class="btn btn-warning btn-sm float-right btn-editar-comentario"
                                    data-toggle="modal" data-target="#editarComentarioModal" data-id="{{ $comentario->id }}"
                                    data-contenido="{{ $comentario->contenido }}">
                                    <i class="fa-solid fa-pencil"></i> Editar
                                </button>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarComentarioModal" tabindex="-1" role="dialog"
        aria-labelledby="editarComentarioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formEditarComentario" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarComentarioLabel">Editar comentario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="contenido" id="contenidoComentario" required maxlength="1000"
                            style="width:100%; height:150px;"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar comentario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginRequeridoModal" tabindex="-1" role="dialog"
        aria-labelledby="loginRequeridoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="loginRequeridoModalLabel"><i class="fa-solid fa-circle-exclamation"></i>
                        Acceso restringido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Para realizar esta acción debes <strong>iniciar sesión</strong> o <strong>registrarte</strong>.<br>
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Iniciar sesión</a>
                    <a href="{{ route('register.form') }}" class="btn btn-outline-secondary mt-3 ml-2">Registrarse</a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/showInstrumentos.js') }}"></script>
    <script>
        var updateUrl = "{{ route('comentarios.update', ':id') }}";
        $('#editarComentarioModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var contenido = button.data('contenido');
            $('#contenidoComentario').val(contenido);
            var actionUrl = updateUrl.replace(':id', id);
            $('#formEditarComentario').attr('action', actionUrl);
        });
    </script>
</body>

</html>