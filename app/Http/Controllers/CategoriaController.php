<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use DB;

class CategoriaController extends Controller
{
    public function __construct()
    {

    }

     public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
    		->where('condicion','=','1')
    		->orderBy('idcategoria','desc')
    		->paginate(7);
    		return view('restaurante.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
    	}
    	
    }
       public function create()
    {
    	return view("restaurante.categoria.create");
    }
       public function store(Request $request)
    {
           $this->validate($request, [
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:256',
        ]);
    	$categoria=new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
    	$categoria->condicion='1';
    	$categoria->save();
    	return Redirect::to('restaurante/categoria');
    }
       public function show($id)
    {
    	return view("restaurante.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
       public function edit($id)
    {
    	return view("restaurante.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
       public function update(Request $request, $id)
    {
         $this->validate($request, [
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:256',
        ]);
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->update();
    	return Redirect::to('restaurante/categoria');
    }
       public function destroy($id)
    {
    	$categoria=Categoria::findOrFail($id);
    	$categoria->condicion='0';
    	$categoria->update();
    	return Redirect::to('restaurante/categoria');
    }

}
