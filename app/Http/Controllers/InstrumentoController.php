<?php

namespace App\Http\Controllers;

use App\Models\Instrumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrumentoController extends Controller
{


    public function index()
    {
        // Obtener los tipos de instrumentos sin duplicados
        $tipos = Instrumento::select('tipo')->distinct()->pluck('tipo');

        $instrumentos = Instrumento::all();

        return view('instrumentos.index', compact('instrumentos', 'tipos'));
    }


    public function show($id)
    {
        $instrumento = Instrumento::findOrFail($id); // Obtener el instrumento por ID
        return view('instrumentos.show', compact('instrumento')); // Pasar el instrumento a la vista
    }
}
