<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
     protected $table = 'detalle_ingreso';

   protected $primaryKey = "idingreso";

   public $timestamps = false;

   protected $fillabel = [
   				'idingreso',
   				'idarticulo',
   				'cantidad',
   				'precio_compra',
   				'precio_venta',
   				
   ];

   protected $guarded = [
   ];
}
