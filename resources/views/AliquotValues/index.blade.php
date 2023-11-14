@extends('adminlte::page')

@section('content_header')
	 Valores de Alicuotas
	<!-- Boton Agregar -->
	<div class="col-md-4">
	      <a href="{{route('AliquotValues.create')}}" type="button" class="btn btn-primary btn-xs">
	          <i class="fa fa-plus" aria-hidden="true"></i> Agregar
	      </a>
	</div>
	<!-- Fin Boton Agregar -->
@endsection

@section('content')
		<!-- Default box -->
<div class="box box-success">
      	<div class="box-body">

					@if( $alicuotValues->count() > 0)
					<table class="table table-bordered table-hover">
					    <thead>
  					    <th>Id</th>
								<th>Tipo Propiedad</th>
  						  <th>Valor</th>
                <th>Fecha Desde</ht>
  					    <th>Fecha Hasta</th>
								<!-- <th>Acciones</th> -->
					    </thead>
					    <tbody>
					      @foreach ($alicuotValues as $alicuotValue)
				        <tr>
			              <td>{{ $alicuotValue->id}}</td>
										<td>{{ $alicuotValue->propertyType->name }}</td>
						        <td>{{ $alicuotValue->value}}</td>
			              <td>{{ $alicuotValue->start_date}}</td>
                    <td>
                      @if ($alicuotValue->end_date != null)
                            {{ $alicuotValue->end_date }}
                      @else
                          Vigente
                      @endif
                    </td>
										<!-- <td>
											@if ($alicuotValue->end_date == null)
											@permission('delete-auth-aliquot-value')
											<a href="" alt="Borrar" type="button"
												data-href="{{ route('AliquotValues.destroy', $alicuotValue->id )}}"
												class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#confirm-delete">
												<i class="fa fa-trash" aria-hidden="true"></i> Borrar
											</a>
											@endpermission
                      @endif

										</td> -->
				          </tr>
					      @endforeach
						</tbody>
					</table>

					@endif


    	</div>
		<!-- /.box-body -->
</div>
		<!-- /.box -->

<div class="box box-success">
	<div class="box-header with-border">
		<i class="fa fa-warning"></i>
		<h3 class="box-title">Indicaciones</h3>
	</div>
	<div class="box-body">
		<div class="alert alert-info alert-dismissible alert-important">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
          Solo Puede Borrar un valor de alicuota que no tenga pagos registrados.
		</div>
	</div>



</div>


<!-- Modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Confirmar Borrado</h4>
				</div>

				<div class="modal-body">
					<p>Estás a punto de eliminar una persona, este procedimiento es irreversible.</p>
					<p>¿Quieres proceder?</p>
					<p class="debug-url"></p>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<a class="btn btn-danger btn-ok">Borrar</a>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script>
        //Date picker
        $('#date_from').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
			language: 'es'
        });

        $("#property_type_id").on('change',function(){

          if($("#property_type_id").val() !== ""){
            alert($("#property_type_id").val());
          }else {
            alert("Seleccione un tipo de propiedad");
          }

        });

	</script>
@endsection
