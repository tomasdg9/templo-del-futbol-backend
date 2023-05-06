<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;

class ClientesController extends Controller
{

   public function show(string $email)
   {
        $clientes = Pedido::where('email', $email)->get();
        return view('clientes.show', ['clientes' => $clientes]);
   }
   /* Tenemos que poder actualizar y destruir a los clientes?
        Conllevaría agregar/editar pedidos, o destruirlos. */
   public function update(Request $request, string $id)
   {
       $cliente = Pedido::find($id);
       $cliente->email = $request->email;
       $cliente->descripcion = $cliente->descripcion;
       $cliente->save();
       return redirect()->route('cliente.index')->with('success', 'Cliente actualizado con éxito');
   }
   public function destroy(string $id)
   {
       $cliente = Pedido::find($id);
       $cliente->delete();
       return redirect()->route('cliente.index')->with('success', 'Cliente eliminado con éxito');
   }

   public function index()
    {
        return redirect()->route('clientes.indexPage', ['page' => 1]);
    }

   public function indexPage(int $page){
        $pageAux = $page - 1;
        $clientes = Pedido::orderBy('email', 'asc')->distinct('email')->skip(6*$pageAux)->take(6)->get();
        $clientesProx = Pedido::orderBy('email', 'asc')->distinct('email')->skip(6*($pageAux+1))->take(6)->get(); // probar take(1)
        $tieneProx = (count($clientesProx) > 0);
        if( count($clientes) == 0)
            return redirect()->route('clientes.indexPage', ['page' => 1]);
        else
            return view('clientes.index', ['clientes' => $clientes, 'page' => $page, 'tieneProx' => $tieneProx]);
    }

    public function searchByName(Request $request){
        $email = $request->input('email');
        $cliente = Pedido::where('email', 'ilike', $email)->first();
        if($cliente){
            return redirect()->route('clientes.show', ['cliente' => $cliente->email]);
        } else {
            return redirect()->route('clientes.indexPage', ['page' => 1])->with('error', 'El cliente no existe');
        }
    }

   // Métodos de la API
   public function storeByAPI(Request $request){

        // Código para crear un nuevo pedido.
        // Los ids de los productos se deben recibir como una cadena del estilo: X1-X2-X3-...-XN Donde Xi es un numero >= 0

        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'descripcion' =>'required|max:500',
            'ids' => 'required|regex:/^\d+(?:-\d+)*$/', // Verficia que los IDs de los productos cumplan con el siguiente formato: X1-X2-X3-...-XN donde Xi es un numero >= 0
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al crear el pedido',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pedido = new Pedido;
        $pedido->email = $request->email;
        $pedido->descripcion = $request->descripcion;
        $pedido->save();
        $ids = $request->ids;
        $ids_array = explode('-', $request->ids);

        foreach ($ids_array as $element) {
            $detallePedido = new DetallePedido;
            $detallePedido->pedido_id = $pedido->id;
            $detallePedido->producto_id = $element;
            $detallePedido->save();
        }

        if($pedido && $pedido->id){
            return response()->json([
                'mensaje' => 'Pedido creado con éxito',
            ]);
        }else{
            return response()->json([
                'mensaje' => 'Error al crear el pedido',
            ], 500);
        }
   }

       // Métodos de la API
       public function showByAPI(string $id)
       {
           $cliente = Pedido::find($id);
           if($cliente)
               return response()->json($cliente);
           else
               return response()->json([
                   'mensaje' => 'Cliente no encontrado'
               ], 404);
       }

       public function showAllByAPI(){
           $clientes = Pedido::all();
           return response()->json($clientes);
       }

}
