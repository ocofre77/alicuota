
@extends('adminlte::page')

@section('contentheader_title')
	 Registro de Condonaciones
@endsection

@section('content')
		<div class="row">
		        <!-- left column -->
		        <div class="col-md-6">
					<!-- Criterios de Búsqueda -->
			    	<div class="box box-success">
			 			<div class="box-body">
							{{-- <label class="" for="lot_number">Número de Lote</label> --}}
							{!! Form::open(['route'=>'Condonations.index', 'method' =>'GET']) !!}
							<div class="row">
									<div class="col-md-12">
										<div class="input-group">
										  {!! Form::text('person_name',null,['class'=> 'form-control','placeholder'=>'Nombre','maxlength' => 30,'aria-describedby'=>'search'])!!}
										  <span class="input-group-btn input-group-sm">
	  										<button class="btn btn-default" type="submit">
	  											<span class="btn-label"><i class="fa fa-search"></i></span>
	  										</button>
	  									</span>
										</div>
									</div>
							</div>

								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
										  {!! Form::text('document_number',null,['class'=> 'form-control','placeholder'=>'Cédula / RUC..','maxlength' => 13,'aria-describedby'=>'search'])!!}
										  <span class="input-group-btn input-group-sm">
	  										<button class="btn btn-default" type="submit">
	  											<span class="btn-label"><i class="fa fa-search"></i></span>
	  										</button>
	  									</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-group">
											{!! Form::text('lot_number',$lot_number,['class'=> 'form-control','placeholder'=>'Lote','maxlength' => 3,'aria-describedby'=>'search'])!!}
											<span class="input-group-btn">
												<button class="btn btn-default" type="submit">
													<span class="btn-label"><i class="fa fa-search"></i></span>
												</button>
											</span>
										</div>
									</div>
								</div>
							{!! Form::close() !!}
				    	</div>
			    	</div>

					<!-- Listado de Propiedades -->
					@if ($properties != null)

					<div class="box box-success">
						<div class="box-body">
							<table class="table table-bordered table-hover" id="tblProperties">
								<thead>
									<th>Propiedad</th>
									<th>Lote</th>
									<th>Residente</th>
									<th>Desde</th>
									<th>Hasta</th>
								</thead>
								<tbody>
								@foreach ($properties as $property)
									<tr>
								    <td>{{ $property->property_type_name}}</td>
								    <td>{{ $property->lot_number}}</td>
										<td>
											<a href="{{ route('Condonations.index', ['person_name'=> $property->person_name ] )}}">
											{{ $property->person_name }}
											</a>
										</td>
										<td>{{ $property->date_from }}</td>
										<td>{{ $property->date_to }}</td>
									</tr>
								@endforeach

								</tbody>

							</table>
						</div>
					</div>
					@endif

				</div>
				<!-- right column -->
				{!! Form::open(['route'=>'Condonations.store', 'id' => 'formPayment','method' =>'POST']) !!}
					<input type="hidden" name="_token" value="{{csrf_token()}}">
				@if($properties != null && $properties->count() > 0 )
				{!! Form::hidden('property_id', $properties->first()->id  ) !!}
				@endif
				<div class="col-md-6">
					<div class="box box-success">

						<div class="box-header">
			              	<h3 class="box-title">PAGOS AÑO:
							</h3>
							<button type="button" id="btnCondonation"
								class="btn btn-success no-margin pull-right">
								<i class="fa fa-money"></i>  Condonar
							</button>
			            </div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-9">
									<div class="form-group">
										<label for="condonationReason">Motivo Condonacion</label>
										<input id="condonationReason" type="text" name="condonationReason" value="" class='form-control'maxlength="60">
									</div>
								</div>
								<div class="col-xs-3">
									<label for="condonationValue"> Valor Condonación</label>
									{!! Form::text('condonationValue',null,['class'=>'form-control','id'=>'condonationValue', 'maxlength'=>3 ]) !!}
								</div>

							</div>
							<div class="bs-callout bs-callout-warning">
								<table class="table table-bordered table-hover" id="tblPayments">
									<thead>
										<th>Año</th>
										<th>Mes</th>
										<th>Valor</th>
										<th>Pago</th>
									</thead>
									<tbody>
									@if( $payments == null)
										<tr>
											<td colspan="4">
												No hay datos
											</td>
										</tr>
									@else
										@foreach($payments as $payment)
										<tr>
											<td>{{$payment->year}}</td>
											<td>{{$payment->month_name}}</td>
											<td>
												@if ( $payment->payment_value > 0 )
													{{ $payment->payment_value }}
												@else
													{{ $payment->value }}
												@endif
											</td>
											<td>
												@if ( $payment->payment_value > 0 )
												<span class="bg-green-active color-palette">PAGADO</span>
												@else
												<span>NO</span>
												{!! Form::checkbox('active[]',$payment->period_id."-".$payment->value, 0) !!}
												@endif
											</td>
										</tr>
										@endforeach
									@endif
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- {!! Form::close() !!} -->
			</form>
		</div>

<!-- Modal -->
<div class="modal fade" id="confirmPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><b>Confirmar Pago</b></h4>
      </div>
      <div class="modal-body">
        <p class="detalle"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-success btn-ok" id="btnAceptPayment">Aceptar</a>
      </div>
    </div>
  </div>
</div>

<!-- begin modal -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Información</h4>
      </div>
      <div class="modal-body">
        <p>El motivo y valor de condonación son obligatorios</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- /.modal -->


@endsection

@section('customScript')
  <script type="text/javascript">

		var tblProperties = $("#tblProperties");
		var tblPayments = $("#tblPayments");

		// Restricts input for each element in the set of matched elements to the given inputFilter.
		$(document).ready(function(){
			$("#lot_number").inputFilter(function(value) {
			  return /^\d*$/.test(value);
			});
		});

		$('#confirm-delete').on('show.bs.modal', function(e) {
		  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		  $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});


		$("#btnAceptPayment").on('click',function(event){
			$("#formPayment").submit();
		});

		$("#btnCondonation").on('click',function(event){
			event.preventDefault();
				var valorAbono = $("#condonationValue").val();
		    if($("#condonationReason").val().length > 20 && Number(valorAbono) > 0 ){
					var items = tblPayments.find('input[type=checkbox]');//.find('td');
					//var countItems = items.length;
					var countItems = 0;
					
					for(var j = 0; j<items.length; j++){
						if($(items[j]).is(':checked')==true){
							countItems= countItems +1;

						}
					}
					var valorAbonoCuota = parseFloat(parseFloat(valorAbono) /  parseFloat(countItems)).toFixed(2);
					var valorAjuste = parseFloat(valorAbono).toFixed(2) - parseFloat(valorAbonoCuota * countItems).toFixed(2);
					var tableConfirmation = $("<table class='table table-bordered table-hover'><thead><th>Año</th><th>Mes</th><th>Valor</th><th>abono</th></thead><tbody></tbody></table>");
					var total = 0.0;
					var totalabono= 0.0;

					for (var i = 0; i < items.length; i++){
						var rows = $(items[i]).parent().parent().find('td');
						var valorCuotaAjuste= 0.0;
						if($(items[i]).is(':checked')==true){

						
							total = total + parseFloat(rows[2].innerText);
							if (parseFloat(valorAjuste).toFixed(2) > 0 ){
								valorCuotaAjuste = parseFloat(valorAbonoCuota) + parseFloat(0.01);
								valorCuotaAjuste = parseFloat(valorCuotaAjuste).toFixed(2);
								valorAjuste = parseFloat(valorAjuste) - parseFloat(0.01);
								valorAjuste = parseFloat(valorAjuste).toFixed(2);
							}
							else if (parseFloat(valorAjuste).toFixed(2) < 0){
								valorCuotaAjuste = parseFloat(valorAbonoCuota) - parseFloat(0.01);
								valorCuotaAjuste = parseFloat(valorCuotaAjuste).toFixed(2);
								valorAjuste = parseFloat(valorAjuste) + parseFloat(0.01);
								valorAjuste = parseFloat(valorAjuste).toFixed(2);
							}
							else {
								valorCuotaAjuste = valorAbonoCuota;
							}
						
							totalabono= parseFloat(totalabono) + parseFloat(valorCuotaAjuste);
							tableConfirmation.append('<tr><td>' + rows[0].innerText + '</td><td>'+ rows[1].innerText + '</td><td>' + rows[2].innerText + '</td><td>'+ valorCuotaAjuste+'</td</tr>');
						}
					}
				
					tableConfirmation.append('<tfoot><tr><td><b>TOTAL</b></td><td></td><td><b>' + total.toFixed(2) + '</b></td><td>'+ parseFloat(totalabono).toFixed(2)+'</td></tr></tfoot>');

					$("#confirmPayment").find(".detalle").html('');
					$("#confirmPayment").find(".detalle").append(tableConfirmation);
		      $("#confirmPayment").modal();
		    }
		    else {
		        $("#myModal").modal();
		    }
		    return false;
		});

  </script>
@endsection
