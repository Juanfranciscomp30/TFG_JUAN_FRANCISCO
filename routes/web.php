<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstrumentoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ComentarioController;

// LOGIN Y REGISTRO
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/recuperar-password', [AuthController::class, 'recuperarPassword'])->name('recuperar.password');


// *** INSTRUMENTOS — rutas públicas ***
Route::get('/instrumentos', [InstrumentoController::class, 'index']); // Listado público
Route::get('/instrumentos/{id}', [InstrumentoController::class, 'show'])->name('instrumentos.show'); // Detalle público

// *** Rutas protegidas ***
Route::middleware('auth')->group(function () {

    // CARRITO (privado)
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
    Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar']);
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::post('/carrito/finalizar', [CarritoController::class, 'finalizarCompra'])->name('compra.finalizar');

    // COMENTARIOS (privado)
    Route::post('/instrumentos/{id}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::get('/comentarios/{id}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
    Route::put('/comentarios/{comentario}', [ComentarioController::class, 'update'])->name('comentarios.update');
    Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
});

