<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Añadir registro</h4>
	</div>
	<div class="modal-body">
		<div class="alert alert-info">
		  <strong>Importante!!</strong> Dejar "---" en los campos vacios.
		</div>
		<form method="POST" action="{{ url('/catastro/add')}}">
		{{ csrf_field() }}
			@foreach ($columns as $column)
				<div class="form-group">
				<label>
					@if ($column == 'ID')
						{{-- NO ES NECESARIO MOSTRARLO, SE AÑADE DE MANERA AUTOMATICA --}}
					@else
						{{ $column }}
					@endif
				</label>
				{{-- ID --}}
					@if ($column == 'ID')
						{{-- NO ES NECESARIO MOSTRARLO, SE AÑADE DE MANERA AUTOMATICA --}}
				{{-- ENARCHIVA --}}
					@elseif ($column == 'EnArchiva')
						<input name="{{ $column }}" type="text" class="form-control" value="0">
				{{-- SERIE --}}
					@elseif ($column == 'Serie')
						<input name="{{ $column }}" type="text" class="form-control" value="---">
				{{-- SIGNATURA --}}
{{-- 					@elseif ($column == 'Signatura')
						<input name="{{ $column }}" type="text" class="form-control" value="0"> --}}
				{{-- PROVINCIA --}}
					@elseif ($column == 'Provincia')
						<div class="form-group">
							<select name="{{ $column }}" class="form-control">
							{{-- Mostramos los distintos fondos que hay, para que se puedan elegir a la hora de editar --}}
								@foreach ($provincias as $provincia)
									<option value="{{ $provincia->ID }}" @if ($provincia->ID === 1) selected="selected" @endif>
										{{ $provincia->Provincia }}
									</option>
								@endforeach
							</select>
						</div>
				{{-- FONDO --}}
					@elseif ($column == 'Fondo')
						<div class="form-group">
							<select name="{{ $column }}" class="form-control">
							{{-- Mostramos los distintos fondos que hay, mostramos por defecto select "---" para que isnerte nulo --}}
								<option value="---"> Eliga un fondo </option>
								@foreach ($fondos as $fondo)
									<option value="{{ $fondo->ID }}">
										{{ $fondo->Fondo }} 
									</option>
								@endforeach
							</select>
						</div>
				{{-- SECCION --}}
					@elseif ($column == 'Seccion')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas secciones que hay, mostramos por defecto select "---" para que isnerte nulo --}}
							<option value="---"> Eliga una sección </option>
							@foreach ($secciones as $seccion)
								<option value="{{ $seccion->ID }}">
									{{ $seccion->Seccion }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- SERIE --}}
					@elseif ($column == 'Serie')
				@elseif ($column === 'Serie')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas series que hay, mostramos por defecto select "---" para que isnerte nulo --}}
							<option value="---"> Eliga una serie </option>
							@foreach ($series as $serie)
								<option value="{{ $serie->ID }}">
									{{ $serie->Serie }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- MUNICIPIO --}}
					@elseif ($column == 'Municipio')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos los distintos municipios que hay, mostramos por defecto select "---" para que isnerte nulo --}}
							<option value="---"> Eliga un municipio </option>
							@foreach ($municipios as $municipio)
								<option value="{{ $municipio->ID }}">
									{{ $municipio->Municipio }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- NORMASDESCRIPCION --}}
					@elseif ($column == 'Norma')
					<div class="form-group">
						<select name="{{ $column }}" class="form-control">
						{{-- Mostramos las distintas normas que hay, mostramos por defecto select "---" para que isnerte nulo --}}
						<option value="---"> Eliga una serie </option>
							@foreach ($normasdescripcion as $norma)
								<option name="normasdescripcion" value="{{ $norma->ID }}">
									{{ $norma->Norma }}
								</option>
							@endforeach
						</select>
					</div>
				{{-- TEXTAREA TITULO --}}
					@elseif ($column === 'Titulo')
						<textarea name="{{ $column }}" class="form-control" rows="3" id="comment">---</textarea>
					@else
						<input name="{{ $column }}" type="text" class="form-control" value="---">
					@endif
				</div>
			@endforeach
			<button type="submit" class="btn btn-default">Añadir</button>
		{{ csrf_field() }}
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
</div>