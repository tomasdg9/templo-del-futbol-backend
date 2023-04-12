<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class ClientesController extends Controller
{
   /* Los clientes pueden ser mostrados, modificados o eliminados. Pero no se puede crear un pedido directamente desde el panel administrativo. */
   public function index()
   {
        $clientes = Pedido::select('*')->distinct('email')->get();
        $counts = [];
        foreach ($clientes as $cliente) {
            $counts[$cliente->email] = Pedido::where('email', $cliente->email)->count(); // Arreglo counts[email] = Cantidad de pedidos
        }
         return view('clientes.index', ['clientes' => $clientes, 'counts' => $counts]); //view(X, Y). X la vista, Y los parametros que se pasan.
         //  los parametros de la vista se ejecutan con {{ }}
   }
   public function show(string $id)
   {
       $cliente = Pedido::find($id);
       return view('clientes.show', ['cliente' => $cliente]);
   }
   public function update(Request $request, string $id)
   {
       $cliente = Pedido::find($cliente);
       $cliente->email = $request->email;
       $cliente->descripcion = $cliente->descripcion;
       $cliente->save();
       return redirect()->route('cliente.index')->with('success', 'Cliente actualizado con éxito');
   }
   public function destroy(string $id)
   {
       $cliente = Pedido::find($cliente);
       $cliente->delete();
       return redirect()->route('cliente.index')->with('success', 'Cliente eliminado con éxito');
   }
}
