<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use Illuminate\Support\Facades\Redirect;

use DB; 

class ProveedorController extends Controller
{
     public function __construct()
    {

    }

     public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$personas=DB::table('persona')
    		->where('nombre','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Proveedor')
    		->orwhere('num_documento','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Proveedor')
    		->orderBy('idpersona','desc')
    		->paginate(7);
    		return view('compras.proveedor.index',["personas"=>$personas,"searchText"=>$query]);
    	}
    	
    }
       public function create()
    {
    	return view("compras.proveedor.create");
    }
       public function store(Request $request)
    {
           $this->validate($request, [
            'nombre' => 'required|max:100',
            'tipo_documento' => 'required|max:20',
            'num_documento' => 'required|max:15',
            'direccion' => 'max:70',
            'telefono' => 'max:15',
            'email' => 'max:50',
        ]);
    	$persona=new Persona;
        $persona->tipo_persona=('Proveedor');
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');

    	$persona->save();
    	return Redirect::to('compras/proveedor');
    }
       public function show($id)
    {
    	return view("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);
    }
       public function edit($id)
    {
    	return view("compras.proveedor.edit",["persona"=>Persona::findOrFail($id)]);
    }
       public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|max:100',
            'tipo_documento' => 'required|max:20',
            'num_documento' => 'required|max:15',
            'direccion' => 'max:70',
            'telefono' => 'max:15',
            'email' => 'max:50',
        ]);

    	$persona=Persona::findOrFail($id);

    	$persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
    	$persona->update();
    	return Redirect::to('compras/proveedor');
    }
       public function destroy($id)
    {
    	$persona=Persona::findOrFail($id);
    	$persona->tipo_persona='Inactivo';
    	$persona->update();
    	return Redirect::to('compras/proveedor');
    }
}
