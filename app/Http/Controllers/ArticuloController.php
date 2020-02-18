<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {

    }

     public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$articulos=DB::table('articulo as a')
    		->join('categoria as c', 'a.idcategoria','=','c.idcategoria')
    		->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
    		->where('a.nombre','LIKE','%'.$query.'%')
            ->where('estado','=','Activo')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->where('estado','=','Activo')
    		->orderBy('a.idcategoria','desc')
    		->paginate(7);
    		return view('restaurante.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
    	}
    	
    }
       public function create()
    {
    	$categorias=DB::table('categoria')->where('condicion', '=', '1')->get();
    	return view("restaurante.articulo.create",["categorias"=>$categorias]);
    }
       public function store(Request $request)
    {
           $this->validate($request, [
           	'idcategoria' => 'required',
           	'codigo' => 'required|max:50',
            'nombre' => 'required|max:50',
            'stock' => 'required|numeric',
            'descripcion' => 'max:512',
            'imagen' => 'mimes:jpeg,bmp,png'
        ]);
    	$articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado='Activo';

    	if($request->hasFile('imagen')){
    		$file=$request->file('imagen');
    		$file->move(public_path().'/imagenes/Articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}

    	$articulo->save();
    	return Redirect::to('restaurante/articulo');
    }
       public function show($id)
    {
    	return view("restaurante.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }
       public function edit($id)
    {
    	$articulo=Articulo::findOrFail($id);
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return view("restaurante.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
       public function update(Request $request, $id)
    {
         $this->validate($request, [
           	'idcategoria' => 'required',
           	'codigo' => 'required|max:50',
            'nombre' => 'required|max:50',
            'stock' => 'required|numeric',
            'descripcion' => 'max:512',
            'imagen' => 'mimes:jpeg,bmp,png'
        ]);
    	$articulo=Articulo::findOrFail($id);

        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
    	$articulo->descripcion=$request->get('descripcion');

    	
        if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/Articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }   

    	$articulo->update();
    	return Redirect::to('restaurante/articulo');
    }
       public function destroy($id)
    {
    	$articulo=Articulo::findOrFail($id);
    	$articulo->estado='Inactivo';
    	$articulo->update();
    	return Redirect::to('restaurante/articulo');
    }
}
