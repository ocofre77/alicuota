
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

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
        {!! Form::Open(['route' => 'Properties.store','method' => 'POST']) !!}
			<div class="box-body">
				<div class="col-sm-6 col-md-3">
	                <div class="form-group">
	                    {!! Form::label('lot_number', 'Lote') !!}
	                    {!! Form::text('lot_number', null ,['class'=>'form-control','placeholder'=>'Número de lote','maxlength' => 3, 'requerid','placeholder'=>'0' ]) !!}
	                </div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
                        {!! Form::label('property_type_id', 'Tipo de Propiedad') !!}
                        {!! Form::select('property_type_id',$propertyTypes,null,['class'=>'select form-control','required', 'placeholder'=>'Seleccione Tipo']) !!}
                    </div>
				</div>

        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('address', 'Dirección') !!}
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </span>
                    {!! Form::text('address',null,['class'=>'form-control','placeholder'=>'Dirección','maxlength' => 80, 'requerid' ]) !!}
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
							{!! Form::text('note',null,['class'=>'form-control','placeholder'=>'Nota','maxlength' => 60, 'requerid' ]) !!}
						</div>
					</div>
				</div>

				{{ Form::hidden('active', '1') }}
                {{ Form::hidden('personId', $personId) }}
				@if( $personId != 0)

				<div class="col-sm-3">
	                {!! Form::label('date_from', 'Fecha Desde (Año/mes/día)') !!}
	                <div class="input-group date">
	                    <div class="input-group-addon">
	                        <i class="fa fa-calendar"></i>
	                    </div>

	                    {!! Form::text('date_from', \Carbon\Carbon::now()->format('Y/m/d'),['class'=>' form-control pull-righ']) !!}
	                </div>
	            </div>

				@endif
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
            <div class="form-group">
                {!! Form::submit('GRABAR',['class'=>'btn btn-primary']) !!}

								<a class="btn btn-labeled btn-default" href="#" onclick="window.history.back();">
						      <span class="btn-label"><i class="fa fa-chevron-left"></i></span>
						      Cancelar
						    </a>

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
	</script>
@endsection
