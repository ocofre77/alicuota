@extends('adminlte::page')

@section('content_header')
    Crear Propiedad
    @if(count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		 <ul>
		 @foreach($errors->all() as $error)
			<li>{{$error}}</li>
		 @endforeach
		 </ul>
	</div>

    @endif
@endsection

@section('content')
<div class="main_container">
	<div class="box box-success">
    {!! Form::Open(['route' => 'AliquotValues.store','method' => 'POST']) !!}
			<div class="box-body">
        <div class="col-sm-6 col-md-3">
					<div class="form-group">
              {!! Form::label('property_type_id', 'Tipo de Propiedad') !!}
              {!! Form::select('property_type_id',$propertyTypes,null,['class'=>'select form-control','required', 'placeholder'=>'Seleccione Tipo']) !!}
          </div>
				</div>
				<div class="col-sm-6 col-md-3">
            <div class="form-group">
                {!! Form::label('value', 'Valor') !!}
                {!! Form::text('value', null ,['class'=>'form-control','placeholder'=>'Valor','maxlength' => 3, 'requerid','placeholder'=>'0' ]) !!}
            </div>
				</div>
        <div class="col-sm-3">
            {!! Form::label('start_date', 'Fecha Desde (Año/mes/día)') !!}
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('start_date', null,['class'=>' form-control pull-righ']) !!}
            </div>
        </div>
      </div>
			<!-- /.box-body -->
			<div class="box-footer">
          <div class="form-group">
              {!! Form::submit('GRABAR',['class'=>'btn btn-primary']) !!}
							<a class="btn btn-labeled btn-default" href="#" onclick="window.history.back();">
					      <span class="btn-label"><i class="fa fa-chevron-left"></i></span>
					      {{ trans('entrust-gui::button.cancel') }}
					    </a>
          </div>
			</div>
    {!! Form::Close() !!}
	</div>
</div>
@endsection

@section('js')
	<script>
        //Date picker
      $('#start_date').datepicker({
          format: 'yyyy/mm/dd',
          autoclose: true,
	        language: 'es'
      });
	</script>
@endsection
