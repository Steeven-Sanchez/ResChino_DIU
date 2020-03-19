@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Proveedor</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div> 
	</div>	
			{!!Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off','files'=> 'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Direccion...">
            </div>
        </div>
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<div class="form-group">
    			<label>Documento</label>
    			<select name="tipo_documento" class="form-control">
    					<option value="CC">CC</option>
                        <option value="PAS">PAS</option>
    			</select>
    			
    		</div>
    	</div>	
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<div class="form-group">
            	<label for="num_documento">Número Documento</label>
                <input type="text" name="num_documento" required value="{{old('num_documento')}}" class="form-control" placeholder="Número Documento...">
            </div>
    	</div>	
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<div class="form-group">
            	<label for="telefono">Teléfono</label>
                <input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Telefono...">
            </div>
    	</div>
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<div class="form-group">
            	<label for="email">Email</label>
                <input type="email" name="email"  value="{{old('email')}}" class="form-control" placeholder="Email...">
            </div>
    	</div>
    	
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Guardar</button>
            	<button class="btn btn-danger" type="reset"><span class="fas fa-minus-circle"></span> Cancelar</button>
            </div> 
    	</div>
    					 	
    </div>	
            
            

			{!!Form::close()!!}

@endsection
