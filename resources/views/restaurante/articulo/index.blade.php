@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-success"><span class="far fa-plus-square"></span> Nuevo</button></a></h3>
		@include('restaurante.articulo.search')
	</div>
</div>

<div  class = " row ">
	<div  class = " col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  class="table table-striped table-border-table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Codigo</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th>Descripcion</th>
					<th>Imagen</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
					<td>{{$art->idarticulo}}</td> 
					<td>{{$art->nombre}}</td> 
					<td>{{$art->codigo}}</td> 
					<td>{{$art->categoria}}</td> 
					<td>{{$art->stock}}</td>
					<td>{{$art->descripcion}}</td>
					<td>
						<div title={{$art->nombre}}>
						<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt= "{{ $art->nombre }}" height="100px" width="100px" class="img-thumbnail">
						</div>
					</td>
					<td>
						<a href = "{{URL::action('ArticuloController@edit',$art->idarticulo)}}"> <button class ="btn btn-info"><span class="far fa-edit"></span> Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger"><span class="fas fa-minus-circle"></span> Eliminar</button></a>
					</td>
				</tr>
				@include('restaurante.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>

@endsection
