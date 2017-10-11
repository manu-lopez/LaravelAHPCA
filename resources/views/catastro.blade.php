@extends('master')
@section('navbarextras')
	<form class="navbar-form navbar-right" method="GET" action="{{ url('/catastro/buscar')}}">
	{{ csrf_field() }}
	      <div class="form-group navbar-left">
          <select name="columnforsearch" class="form-control">
	      		@foreach ($columns as $column) {{-- Recorremos las columnas y las mostramos --}}
	      			@if ($column === 'ID') @elseif ($column === 'EnArchiva')
	      				{{-- No los mostramos --}}
	      			@else
	      				<option value="{{ $column }}">{{ $column }}</option>
	      			@endif
				@endforeach
			</select>
      </div>
        <div class="form-group">
          <input name="data" type="text" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      {{ csrf_field() }}
	</form>
@endsection
@section('css')
	<style>
	#eltitulo{
    	margin-top: 0px;
    	margin-bottom: 30px;
	}
	#containerbody, #divTable{
		width: 95%;
	}
	#divTable{
		overflow: scroll; /*Con esto conseguimos el scroll de la tabla*/
	}
	#idTable{
	    white-space: nowrap; /*Asi ponemos todos los campos en una linea*/
	}
	.modal-dialog{ /* Lo hacemos más ancho y añadimos scroll*/
      width:90%;
      overflow:scroll;
    }
    .modal-body { /* Fijamos tanto el header como el footer del modal*/
    max-height: calc(100vh - 210px);
    overflow-y: scroll;
	}
	</style>
@endsection

@section('body')
<div class="container">
	@if (session()->has('message'))
	  	<div class="alert alert-success alert-dismissable">
    		<a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>X</strong></a>
    		{{ session()->get('message') }}
  		</div>
  	@elseif (session()->has('error'))
	  	<div class="alert alert-danger alert-dismissable">
    		<a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>X</strong></a>
    		{{ session()->get('error') }}
  		</div>
	@endif
</div>

{{-- Boton añadir registro --}}
<div id="containerbody" class="container" style="margin-top: 15px;">
	<div class="row">
		<div class="col-md-1" style="display:inline; margin-bottom: 20px">
			<h2 id="eltitulo">Catastro</h2>
		</div>
		<div id="elboton" class="col-md-1 col-md-offset-10" style="display:inline">
			<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#addModal"> Añadir </button>
		</div>
	</div>

{{-- Modal añadir registro --}}
	<div class="container">
		<div id="addModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			{{-- Contenido Modal--}}
				@include('modal.add')
			</div>
		</div>
	</div>

{{-- Tabla con datos --}}
	<div class="container" id="divTable" style="margin-bottom: 30px">
		<table id="idTable" class="table table-hover table-striped table-bordered sortable">
			<tr>
				<th> Acción </th>
				@foreach ($columns as $column) {{-- Recorremos las columnas y las mostramos --}}
					<th>{{ $column }}</th>
				@endforeach
			</tr>
			<tr>
				@foreach($dataset as $data) {{-- Recorremos los datos--}}
					<tr>
						<td> 
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target-id="{{ $data->ID }}" data-target="#editModal"> Editar </button> 
						</td>
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

{{-- Modal editar --}}
	<div class="container">
		<div id="editModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			{{-- Contenido Modal--}}
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"> Editar </h4>
					</div>

					@include('modal.edit')
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar </button>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Botones Pagination --}}
	<div class="row">
		<div class="col-md-10" style="display:inline">
			{{ $dataset->links() }}
		</div>
		<div class="col-md-offset-2" style="display:inline">
			<p>{{ $dataset->total() }} registros en total</p>
		</div>
	</div>	
</div>

@push('scripts')
<script>
    $(document).ready(function(){
      $("#editModal").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('target-id');
        $.get('/catastro/edit/' + id, function( data ) {
      		$("#edit-modal-body").html(data);
        });
      });
    });
</script>
@endpush
@endsection