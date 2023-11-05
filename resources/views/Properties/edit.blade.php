@extends('adminlte::page')
@section('title', 'AdminLTE')

@section('contentheader_title')
    Editar Propiedad
@endsection

@section('content')
 @if(count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		 <ul>
		 @foreach($errors->all() as $error)
			<li>{{$error}}</li>
		 @endforeach
		 </ul>
	</div>

 @endif
<div class="main_container">
	<div class="box box-success">
		<div class="box-header">
		</div>

        {!! Form::Open(['route' => ['Properties.update',$property],'method' => 'PUT']) !!}
		<div class="box-body">
			<div class="col-sm-6 col-md-3">
                <div class="form-group">
                	<div class="form-group">
                		{!! Form::label('lot_number', 'Lote') !!}
                		{!! Form::text('lot_number', $property->lot_number ,['class'=>'form-control','placeholder'=>'Numero de Lote','maxlength' => 3, 'requerid' ]) !!}
            		</div>
			   </div>
		 	</div>
			<div class="col-sm-6 col-md-3">
				<div class="form-group">
					{!! Form::label('property_type_id', 'Tipo de Propiedad') !!}
					{!! Form::select('property_type_id',$propertyTypes,$property->property_type_id,['class'=>'select form-control','required', 'placeholder'=>'Seleccione Tipo']) !!}
				</div>
			</div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('address', 'Dirección') !!}
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </span>
                        {!! Form::text('address',$property->address,['class'=>'form-control','placeholder'=>'Dirección','maxlength' => 60, 'requerid' ]) !!}
                    </div>
                </div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					{!! Form::label('note', 'Nota') !!}
					<div class="input-group">
						<span class="input-group-addon" id="sizing-addon2">
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
						</span>
						{!! Form::text('note',$property->note,['class'=>'form-control','placeholder'=>'Nota','maxlength' => 60, 'requerid' ]) !!}
					</div>
				</div>
			</div>

			@if( $personId != 0)
			{{ Form::hidden('personPropertyId', $personProperty->first()->id) }}
			<div class="col-sm-3">
                {!! Form::label('date_from', 'Fecha Desde (Año/mes/día)') !!}
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('date_from', $personProperty[0]->date_from,['class'=>' form-control pull-righ']) !!}
                </div>
            </div>
			<div class="col-sm-3">
                {!! Form::label('date_to', 'Fecha Hasta (Año/mes/día)') !!}
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('date_to', $personProperty[0]->date_to,['class'=>' form-control pull-righ']) !!}
                </div>
            </div>
			@endif
		</div>

		<div class="box-footer">
			<div class="form-group">
                {!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
            </div>
		</div>

		{!! Form::Close() !!}
	</div>
</div>
@endsection

@section('customScript')
	<script>
        //Date picker
        $('#date_from').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
			language: 'es'
        });

		$('#date_to').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
			language: 'es'
        });

	</script>
@endsection
