<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\IngresoFormRequest;
use sisVentas\Ingreso;
use sisVentas\Detallengreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
     public function __construct(){

   }
   public function index(Request $request){

   		if ($request) {
   			$query=trim($request->get('searchText'));
   			$ingresos=DB::table('ingreso as i')
   			->join('persona as p','i.proveedor','=','p.persona')
   			->join('detalle_ingreso as di','i.ingreso','=','di.ingreso')
   			->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
   			->where('i.num_comprobante','LIKE','%'.$query.'%')
   			->ordenBy('i.idingreso','desc')
   			->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
   			->paginate(7);
   			return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);

   			
   		}

   }
   public function create(){

      $personas=DB::table('persona') where('tipo_persona','=', 'proveedor')->get();
      $articulos=DB::table('articulo as art')
      ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) AS articulo'),'art.idarticulo')
      ->where('art.estado','=','Activo')
      ->get(); 
      return view('compras.ingreso.create',["personas"=>$personas,"articulos"=>$articulos]);

   }

   public function store(IngresoFormRequest $request){

   	  try {
   	  	DB::beginTransaction();
   	  	$ingreso=new Ingreso;
   	  	$ingreso->idproveedor=$request->get('idproveedor');
   	  	$ingreso->tipo_comprobante=$request->get('tipo_comprobante');
   	  	$ingreso->serie_comprobante=$request->get('serie_comprobante');
   	  	$ingreso->num_comprobante=$request->get('num_comprobante');
   	  	$ingreso->idproveedor=$request->get('idproveedor');
   	  	$mytime = Carbon::now('America/Lima');
   	  	$ingreso->fecha_hora=$mytime->toDateTimeString();
   	  	$ingreso->impuesto="18";
   	  	$ingreso->estado='A';
   	  	$ingreso->save();

   	  	<button class="btn btn-primary" type="button">hola soy yo</button>
   	  	$idarticulo=$request->get('idarticulo');
   	  	$cantidad=$request->get('cantidad');
   	  	$precio_compra=$request->get('precio_compra');
   	  	$precio_venta=$request->get('precio_venta');

   	  	$cont=0

   	  	while ($cont < $cont($idarticulo)) {
   	  	    $detalle = new Detallengreso();
   	  	    $detalle->idingreso=$ingreso->idingreso;
   	  	    $detalle->idarticulo=$idarticulo[$cont];
   	  	    $detalle->cantidad=$cantidad[$cont];
   	  	    $detalle->precio_compra=$precio_compra[$cont];
   	  	    $detalle->precio_venta=$precio_venta[$cont];
   	  	    $detalle->save();
   	  	    $cont=$cont + 1;

   	  	}

   	  	DB::commit();

   	  	
   	  } catch (\Exception $e) {

          DB::rollback();
   	  	
   	  }

   	  return Redirect::to('compras/ingreso');

   }

   public function show(id)
   {
   	      $ingreso=DB::table('ingreso as i')
   			->join('persona as p','i.proveedor','=','p.persona')
   			->join('detalle_ingreso as di','i.ingreso','=','di.ingreso')
   			->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
   			->where('i.idingreso','=',$id)
   			->first();
   		  $detalles=DB::table('detalle_ingreso as d')
   			->join('articulo as a','d.idarticulo','=','a.idarticulo')
   			->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
   			->where('d.ingreso','=',$id)
   			->get();
   			return view("compras,ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
   }

   public function destroy($id)
   {
   	$ingreso=Ingreso::findOrFail($id)
   	$ingreso->Estado='C';
   	$ingreso->update();
   	return Redirect::to ('compras/ingreso');

   }

}
 