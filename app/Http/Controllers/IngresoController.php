<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\DetalleIngreso;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use DB; 
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller 
{
     public function __construct()
    {

    }

     public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$ingresos=DB::table('ingreso as i')
    		->join('persona as p','i.proveedor','=','p.idpersona')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra")as total'))
    		->where('i.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('i.idingreso','desc')
    		->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
    		->paginate(7);
    		return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
    	}
    	
    }

    public function create()

    {
    	$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
    	$articulos=DB::table('articulo as art')
    		->select(DB::raw('CONCAT(art.codigo," ",art.nombre)AS articulo'),'art.idarticulo')
    		->where('art.estado','=','Activo')
    		->get();
    	return view('compras.ingreso.create',["personas"=>$personas,"articulos"=>$articulos]);
    }

     public function store(Request $request)
    {
    	$this->validate($request, [
            'idproveedor' => 'required',
    		'tipo_comprobante' => 'required|max:20',
    		'serie_comprobante' => 'max:10',
    		'num_comprobante' => 'required|max:10',
    		'idarticulo' => 'required',
    		'cantidad' => 'required',
    		'precio_compra' => 'required',
    		'precio_venta' => 'required',
        ]);
    }

}