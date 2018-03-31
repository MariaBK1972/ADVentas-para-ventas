@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente {{ $persona->nombre}} </h3>
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
			{!!Form::model($persona,['method'=>'PATCH','route'=>['cliente.update',$persona->idpersona]])!!}
			{{Form::token()}}
	
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre....>">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Direccion</label>
				<input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="Direccion....>">
			</div>
		</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Documento</label>
				  <select name="tipo_documento" class="form-control">
				  	@if ($persona->tipo_documento=='V')
				  	  <option value="V" selected>V</option>
				  	  <option value="J">J</option>
				  	  <option value="E">E</option>
				  	  <option value="P">P</option>
				  	 @elseif ($persona->tipo_documento=='J')
				  	  <option value="V">V</option>
				  	  <option value="J" selected>J</option>
				  	  <option value="E">E</option>
				  	  <option value="P">P</option>
				  	 @elseif ($persona->tipo_documento=='E')
				  	  <option value="V">V</option>
				  	  <option value="J">J</option>
				  	  <option value="E" selected>E</option>
				  	  <option value="P">P</option>
				  	@else
				  	  <option value="V">V</option>
				  	  <option value="J">J</option>
				  	  <option value="E">E</option>
				  	  <option value="P" selected>P</option>
				  	@endif

				  </select>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Numero Documento</label>
				<input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Numero de Documento....>">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Telefono</label>
				<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Telefono....>">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Email</label>
				<input type="email" name="email" value="{{$persona->email}}" class="form-control" placeholder="Email....>">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			
			</div>
		</div>
	
	</div>
			{!!Form::close()!!}

@endsection