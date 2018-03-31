<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
   protected $table = 'persona';

   protected $primaryKey = "idpersona";

   public $timestamps = false;

   protected $fillabel = [
   				'tipo_persona',
   				'nombre',
   				'tipo_documento',
   				'num_documento',
   				'direccion',
   				'telefono',
   				'email'
   ];

   protected $guarded = [
   ];

}
