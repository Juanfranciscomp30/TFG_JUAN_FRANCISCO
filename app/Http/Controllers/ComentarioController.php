<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'instrumento_id' => 'required|exists:instrumentos,id',
            'contenido' => 'required|string|max:1000',
        ]);

        Comentario::create([
            'user_id' => auth()->id(),
            'instrumento_id' => $request->instrumento_id,
            'contenido' => $request->contenido,
        ]);

        return back()->with('success', 'Comentario añadido correctamente.');
    }
    public function destroy(Comentario $comentario)
    {
        // Solo puede borrar el dueño del comentario
        if ($comentario->user_id !== auth()->id()) {
            abort(403, 'No autorizado');
        }

        $comentario->delete();

        return back()->with('success', 'Comentario eliminado correctamente.');
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, Comentario $comentario)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
        ]);

        $comentario->contenido = $request->contenido;
        $comentario->save();

        return redirect()->route('instrumentos.show', $comentario->instrumento_id)
            ->with('success', 'Comentario actualizado correctamente.');
    }


}
