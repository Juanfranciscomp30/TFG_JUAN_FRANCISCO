<?php
namespace App\Http\Controllers;

use App\Models\Instrumento;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
{
    $id = $request->input('instrumento_id');
    $instrumento = Instrumento::findOrFail($id);
    $carrito = session()->get('carrito', []);

    // Si ya está en el carrito
    if (isset($carrito[$id])) {
        // Comprobar si hay stock suficiente antes de incrementar
        if ($carrito[$id]['cantidad'] + 1 > $instrumento->stock) {
            return back()->with('error', 'No hay suficiente stock para añadir más unidades.');
        }
        $carrito[$id]['cantidad']++;
    } else {
        // Comprobar que hay al menos 1 en stock
        if ($instrumento->stock < 1) {
            return back()->with('error', 'No hay stock disponible de este instrumento.');
        }
        $carrito[$id] = [
            'id' => $id,
            'marca' => $instrumento->marca,
            'modelo' => $instrumento->modelo,
            'precio' => $instrumento->precio,
            'cantidad' => 1,
            'foto' => $instrumento->foto,
            'color' => $request->input('color'),
            'stock' => $instrumento->stock,
        ];
    }

    session()->put('carrito', $carrito);
    return redirect()->back()->with('success', 'Producto añadido al carrito');
}



    // Puedes crear otro método para mostrar el carrito
    public function ver()
    {
        // Obtén el carrito de la sesión
        $carrito = session()->get('carrito', []);

        return view('carrito.index', compact('carrito'));
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver')->with('success', 'Producto eliminado del carrito.');
    }

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $cantidad = $request->input('cantidad');
    
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            $stock = $carrito[$id]['stock'] ?? 99;
            if ($cantidad > 0 && $cantidad <= $stock) {
                $carrito[$id]['cantidad'] = $cantidad;
                session()->put('carrito', $carrito);
                return back()->with('mensaje', 'Cantidad actualizada correctamente');
            } else {
                return back()->with('error', 'Cantidad no válida o sin stock suficiente');
            }
        }
        return back()->with('error', 'No se pudo actualizar la cantidad');
    }
    

    public function finalizarCompra(Request $request)
    {
        $carrito = session('carrito', []);
        $errores = [];
    
        // Primero comprobamos que todos los productos tienen stock suficiente
        foreach ($carrito as $id => $item) {
            $instrumento = Instrumento::find($id);
    
            if (!$instrumento || $instrumento->stock < $item['cantidad']) {
                $errores[] = $item['marca'] . ' ' . $item['modelo'];
            }
        }
    
        if (count($errores) > 0) {
            // Si hay errores, mostramos cuáles no tienen stock suficiente
            return back()->with('error', 'No hay stock suficiente para: ' . implode(', ', $errores));
        }
    
        // Si todo bien, restamos el stock y guardamos
        foreach ($carrito as $id => $item) {
            $instrumento = Instrumento::find($id);
            $instrumento->stock -= $item['cantidad'];
            $instrumento->save();
        }
    
        // Vaciar carrito al finalizar
        session()->forget('carrito');
    
        return redirect('/instrumentos')->with('success', 'Compra finalizada correctamente. ¡Gracias por tu pedido!');
    }
    

}
