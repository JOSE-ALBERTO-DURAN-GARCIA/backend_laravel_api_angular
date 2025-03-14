<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/auth')-> group(function(){

Route::post("/login", [AuthController::class, "funIngresar"]);
Route::post("register", [AuthController::class, "funRegistro"]);


// con esto  estamos protegien la ruta del perfil y salir
Route::middleware('auth:sanctum')->group(function(){
Route::get("/profile", [AuthController::class, "funPerfil"]);
Route::post("/logout", [AuthController::class, "funSalir"]);    
});

});
Route::middleware('auth:sanctum')->group(function(){


    Route::post("producto/{id}/actualizar-imagen", [ProductoController::class, "actualizarImagen"]);

    Route::get("cliente/buscar", [ClienteController::class, "buscarCliente"]);
         //usuario
    Route::apiResource("usuario", UsuarioController::class);
    Route::apiResource("persona", PersonaController::class);
    Route::apiResource("producto", ProductoController::class);
    Route::apiResource("categoria", CategoriaController::class);
    Route::apiResource("cliente", ClienteController::class);
    Route::apiResource("pedido", PedidoController::class);
});



