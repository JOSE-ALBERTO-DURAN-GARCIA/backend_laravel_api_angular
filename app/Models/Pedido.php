<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;


    public function productos()
    {
       return $this->belongsToMany(Producto::class)
                   ->withPivot(["cantidad"])
                   ->withTimestamps();
    }

    public function cliente()
    {
       return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generarCodigoPedido(){
        $ultimoCodigo = Pedido::max('cod_pedido');
        $numero = 1;

        if($ultimoCodigo){
            // Extrae el numero de pedido existente y agrega 1
            $numero = intval(substr($ultimoCodigo, 4)) + 1;
        }
        // Genera el nuevo codigo de pedido
        return 'PED_' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }
}
