{!! Form::open(array('url'=>'restaurante/categoria','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class = "form-group">
	<div class="input-group">
		<input  type ="text" class="form-control" name="searchText" placeholder="Buscar..."value="{{$searchText}}">
		<span clase="input-group-btn" >
			<button type="submit" class="btn btn-primary"><span class="fas fa-search"></span> Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}
