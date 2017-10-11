@extends('master')

@section('css')
<style>
	#containerbody, #divTable{
		width: 95%;
	}
	#divTable{
		overflow: scroll; /*Con esto conseguimos el scroll de la tabla*/
	}
	#idTable{
	    white-space: nowrap; /*Asi ponemos todos los campos en una linea*/
	}
</style>
@endsection

@section('body')
<a class="navbar-brand" href="{{  url('/catastro') }}" style="font-size: 22px">Volver</a>
<div class="container" id="divTable" style="margin-bottom: 30px">
		<table id="idTable" class="table table-hover table-striped table-bordered sortable">
			<tr>
				@foreach ($columns as $column) {{-- Recorremos las columnas y las mostramos --}}
					<th>{{ $column }}</th>
				@endforeach
			</tr>
			<tr>
				@foreach($datos as $data) {{-- Recorremos los datos--}}
					<tr>
						@foreach ($columns as $column)	 {{-- Recorremos las columnas para sacar el dato correspondiente --}}
							@if($data->$column === Null or $data->$column === '')
								<td> --- </td>
							@else
								<td>{{ $data->$column }}</td>
							@endif
						@endforeach
					</tr>
				@endforeach
			</tr>
		</table>
</div>
		<div class="row">
			<div class="col-md-10" style="display:inline">
				{{ $datos->setPath('buscar')->render() }}
			</div>
			<div class="col-md-offset-2" style="display:inline">
				<p>{{ $datos->total() }} registros en total</p>
			</div>
		</div>
@endsection