<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Carrito</title>
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
</head>

<body>
    @include('layouts.barraNavegacion')

    <div class="container mt-5">
        <h1 class="mb-4 carrito-title"><i class="fa-solid fa-cart-shopping"></i> Carrito de Compras</h1>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('carrito') && count(session('carrito')) > 0)
            <div class="row">
                @foreach(session('carrito') as $id => $item)
                    <div class="col-md-4 mb-4 card-item-{{$item['id']}}">
                        <div class="card shadow-sm h-100">
                            <img src="https://via.placeholder.com/400x170?text={{ urlencode($item['marca']) }}"
                                class="card-img-top" alt="Instrumento">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">{{ $item['marca'] }} - {{ $item['modelo'] }}</h5>
                                <span class="badge badge-color px-2 py-1"><i class="fa-solid fa-palette"></i>
                                    {{ $item['color'] }}</span>
                                <p class="mb-1"><strong>Precio:</strong> €{{ number_format($item['precio'], 2) }}</p>
                                <p class="mb-1"><strong>Stock:</strong> {{ $item['stock'] ?? 'N/D' }}</p>
                                <p class="mb-1">
                                    <strong>Cantidad:</strong>
                                <form action="{{ route('carrito.actualizar') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <div class="input-group" style="width: 120px;">
                                        <input type="number" name="cantidad" min="1" max="{{ $item['stock'] ?? 99 }}"
                                            value="{{ $item['cantidad'] }}" class="form-control form-control-sm"
                                            style="width: 60px;">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success btn-sm" type="submit"
                                                title="Actualizar cantidad">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </p>
                                <span class="subtotal mb-3" id="subtotal-{{ $item['id'] }}">
                                    <i class="fa-solid fa-money-bill"></i> Subtotal:
                                    €{{ number_format($item['cantidad'] * $item['precio'], 2) }}
                                </span>
                                <form class="eliminar-form mt-auto" data-id="{{$item['id']}}"
                                    action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100 mt-2" type="submit">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-4">
                    <div class="total-cesta mt-4 shadow-sm">
                        Total:
                        €{{ number_format(collect(session('carrito'))->sum(fn($item) => $item['cantidad'] * $item['precio']), 2) }}
                    </div>
                </div>
            </div>

            <div class="text-right mb-5">
            <button type="button" class="btn btn-success px-4 py-2" data-toggle="modal" data-target="#modalFinalizarCompra">
    <i class="fa-solid fa-credit-card"></i> Finalizar Compra
</button>
            </div>

            <!-- Modal Finalizar Compra -->
            <div class="modal fade" id="modalFinalizarCompra" tabindex="-1" aria-labelledby="modalFinalizarCompraLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 20px;">
                        <div class="modal-header" style="background: var(--opal);">
                            <h5 class="modal-title" id="modalFinalizarCompraLabel">
                                <i class="fa-solid fa-credit-card"></i> Finalizar Compra
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="background: var(--champagne);">
                            <p>¿Estás seguro que deseas finalizar tu compra?</p>
                        </div>
                        <div class="modal-footer" style="background: var(--opal);">
                            <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('compra.finalizar') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirmar Compra</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card my-5 py-5 shadow-sm">
                <span class="empty-cart-emoji">🛒</span>
                <div class="card-body text-center">
                    <h4 class="text-muted">Tu carrito está vacío.</h4>
                    <a href="{{ url('/instrumentos') }}" class="btn btn-outline-success mt-3">
                        <i class="fa-solid fa-arrow-left"></i> Seguir comprando
                    </a>
                </div>
            </div>
        @endif
    </div>
    @include('layouts.footer')


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/carrito.js') }}"></script>


</body>

</html>