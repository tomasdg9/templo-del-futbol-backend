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

   public function index()
    {
        return redirect()->route('clientes.indexPage', ['page' => 1]);
    }

   public function indexPage(int $page){
        $pageAux = $page - 1;
        $clientes = Pedido::orderBy('email', 'asc')->distinct('email')->skip(6*$pageAux)->take(6)->get();
        $clientesProx = Pedido::orderBy('email', 'asc')->distinct('email')->skip(6*($pageAux+1))->take(6)->get(); // probar take(1)
        $tieneProx = (count($clientesProx) > 0);

        $clientes = $clientes->map(function($cliente) {
            $cliente->cantidadPedidos = count(Pedido::where('email', $cliente->email)->get());
            return $cliente;
        });
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

/**
 * @OA\Post(
 *     path="/rest/pedidos/crear",
 *     summary="Crea un nuevo pedido por API",
 *     @OA\Parameter(
 *         name="request",
 *         in="path",
 *         description="Request de los pedidos",
 *         required=true,
 *         @OA\Schema(
 *             type="request"
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error al crear pedido")
 *     ,
 *     @OA\Response(
 *         response=200,
 *         description="Pedido creado con exito"),
 *     @OA\Response(
 *         response=500,
 *         description="Error al crear pedido")
 *     )
 */
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

/**
 * @OA\Get(
 *     path="/rest/pedidos/{id}",
 *     summary="Muestra pedido segun id por API",
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del pedido",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cliente y su id")
 *     ,
 *     @OA\Response(
 *         response=404,
 *         description="Cliente no encontrado")
 * )
 */
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

/**
 * @OA\Get(
 *     path="/rest/pedidos/email/{email}",
 *     summary="Muestra cliente segun su email por API",
 *      @OA\Parameter(
 *         name="email",
 *         in="path",
 *         description="email del cliente",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 * 
 *     @OA\Response(
 *         response=200,
 *         description="Cliente segun su email")
 *     ,
 *     @OA\Response(
 *         response=404,
 *         description="Cliente no encontrado")
 * 
 * )
 */
    public function showEmailByAPI(string $email)
    {
        $cliente = Pedido::where('email', 'ilike', $email)->get();
        if(count($cliente)>0)
            return response()->json($cliente);
        else
            return response()->json([
                'mensaje' => 'Cliente no encontrado'
            ], 404);
    }

/**
 * @OA\Get(
 *     path="/rest/pedidos",
 *     summary="Muestra todos los pedidos por API",
 *     @OA\Response(
 *         response=200,
 *         description="Pedidos")
 * )
 */
    public function showAllByAPI(){
        $clientes = Pedido::all();
        return response()->json($clientes);
    }

/**
 * @OA\Get(
 *     path="/rest/pedidos/page/{page}",
 *     summary="Muestra los pedidos por pagina",
 *     @OA\Parameter(
 *         name="page",
 *         in="path",
 *         description="pagina del pedido",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pagina de pedidos")
 *     ,
 *     @OA\Response(
 *         response=404,
 *         description="Pagina no encontrada")
 * 
 * )
 */
public function showPageByAPI(string $page){
        $pageAux = $page - 1;
        $clientes = Pedido::orderBy('id', 'asc')->skip(6*$pageAux)->take(6)->get();
        if( count($clientes) == 0)
        return response()->json([
            'mensaje' => 'Página de pedidos no encontrada'
        ], 404);
        else
            return response()->json($clientes);
    }

}
