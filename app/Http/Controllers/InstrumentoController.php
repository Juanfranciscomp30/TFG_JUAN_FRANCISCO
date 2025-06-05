<?php

namespace App\Http\Controllers;

use App\Models\Instrumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrumentoController extends Controller
{


    public function index(Request $request)
    {
        // Obtener todos los tipos de instrumentos (sin duplicados)
        $tipos = Instrumento::select('tipo')->distinct()->pluck('tipo');

        $query = Instrumento::query();

        // Filtrar por tipo si se ha seleccionado
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtrar por modelo si se ha proporcionado
        if ($request->filled('modelo')) {
            $query->whereRaw('LOWER(modelo) LIKE ?', ['%' . strtolower(trim($request->modelo)) . '%']);
        }

        // Filtrar por precio si se ha proporcionado
        if ($request->filled('precioMax')) {
            $query->where('precio', '<=', $request->precioMax);
        }

        // Obtener los resultados filtrados
        $instrumentos = $query->get();

        return view('instrumentos.index', compact('instrumentos', 'tipos'));
    }

    public function show($id)
    {
        $instrumento = Instrumento::findOrFail($id); // Obtener el instrumento por ID
        return view('instrumentos.show', compact('instrumento')); // Pasar el instrumento a la vista
    }
}
