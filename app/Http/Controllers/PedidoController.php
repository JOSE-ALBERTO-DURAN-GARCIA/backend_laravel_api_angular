<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(["cliente", "productos", "user"])->orderBy('fecha', 'desc')->paginate(10);

        return response()->json($pedidos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "cliente_id" => "required",
            "productos" => "required"
        ]);

        DB::beginTransaction();
        try {
            //guardar
            $pedido = new Pedido();
            $pedido->fecha = date("Y-m-d H:i:s");
            $pedido->cod_pedido = Pedido::generarCodigoPedido();
            $pedido->cliente_id = $request->cliente_id;
            $pedido->user_id = Auth::user()->id;
            $pedido->save();

            //asignacinamos los productos al pedido
            $productos = $request->productos;
            foreach ($productos as $prod) {
                $cant = $prod["cantidad"];
                $id = $prod["id"];

                $producto=Producto::find($id);
                $producto->stock = $producto->stock - $cant;
                $producto->update();

                $pedido->productos()->attach($id, ["cantidad" => $cant]);
            }

            $pedido->estado = 2;
            $pedido->observaciones = $request->observaciones;
            $pedido->update();

            DB::commit();

            return response()->json(["message", "data" => $pedido], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(
                [
                  "message" => "Ocurrio un problema al registrar el pedido", 
                  "error" => $e->getMessage()
                ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
