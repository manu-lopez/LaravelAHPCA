<div class="modal-body" id="edit-modal-body">
	<div class="alert alert-info">
	  <strong>Importante!!</strong> Dejar "---" en los campos vacios.
	</div>
	<form method="POST" action="{{ url('/catastro/save')}}">
	{{ csrf_field() }}
		<div class="form-group">
			@foreach ($columns as $column)
				<label>{{ $column }}</label>
				{{-- FONDO --}}
				@if ($column === 'Fondo')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos los distintos fondos que hay, para que se puedan elegir a la hora de editar --}}
							@foreach ($fondos as $fondo)
								<option value="{{ $fondo->ID }}" @if ($fondo->Fondo === $data->$column) selected="selected" @endif>
									{{ $fondo->Fondo }} 
								</option>
							@endforeach
						</select>
					</div>
				{{-- SECCION --}}
				@elseif ($column === 'Seccion')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas secciones que hay, para que se puedan elegir a la hora de editar --}}
							@foreach ($secciones as $seccion)
								<option value="{{ $seccion->ID }}" @if ($seccion->Seccion === $data->$column) selected="selected" @endif>
									{{ $seccion->Seccion }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- SERIE --}}
				@elseif ($column === 'Serie')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas series que hay, para que se puedan elegir a la hora de editar --}}
							@foreach ($series as $serie)
								<option value="{{ $serie->ID }}" @if ($serie->Serie === $data->$column) selected="selected" @endif>
									{{ $serie->Serie }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- Textarea TITULO --}}
				@elseif ($column === 'Titulo')
					<textarea name="{{ $column }}" class="form-control" rows="3" id="comment">{{ $data->$column }}</textarea>
				{{-- PROVINCIA --}}
				@elseif ($column === 'Provincia')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas provincias que hay, para que se puedan elegir a la hora de editar --}}
							@foreach ($provincias as $provincia)
								<option value="{{ $provincia->ID }}" @if ($provincia->Provincia === $data->$column) selected="selected" @endif>
									{{ $provincia->Provincia }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- MUNICIPIO --}}
				@elseif ($column === 'Municipio')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos los distintos municipios que hay, para que se puedan elegir a la hora de editar --}}
							@foreach ($municipios as $municipio)
								<option value="{{ $municipio->ID }}" @if ($municipio->Municipio === $data->$column) selected="selected" @endif>
									{{ $municipio->Municipio }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- NORMASDESCRIPCION --}}
				@elseif ($column === 'Norma') {{-- la columna de la tabla no es NormaDescripcion, en el resto corresponde entre columnas de las tablas --}}
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas normas que hay, para que se puedan elegir a la hora de editar --}}
							@foreach ($normasdescripcion as $norma)
								<option name="normasdescripcion" value="{{ $norma->ID }}" @if ($norma->Norma === $data->$column) selected="selected" @endif>
									{{ $norma->Norma }}
								</option>
							@endforeach
						</select>
					</div>
				@elseif ($column == 'ID')
					<input name="{{ $column }}" type="text" class="form-control" value="{{ $data->$column }}" readonly>
				@else
					@if($data->$column === Null or $data->$column === '')
						<input name="{{ $column }}" type="text" class="form-control" value="---"> {{-- Colocamos "---" para luego comprobar si es nulo y no colocar NULL directamente en la interfaz--}}
					@else
						<input name="{{ $column }}" type="text" class="form-control" value="{{ $data->$column }}">
					@endif
				@endif
			@endforeach
		</div>
		<button type="submit" class="btn btn-default">Guardar Cambios</button>
       	{{ csrf_field() }}
	</form>
</div>