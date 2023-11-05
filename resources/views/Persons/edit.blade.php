
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

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
        {!! Form::Open(['route' => ['Persons.update',$person],'method' => 'PUT']) !!}
            <div class="box-body">
				<div class="col-md-4">
					<div class="form-group">
                        {!! Form::label('person_type_id', 'Tipos') !!}
                        {!! Form::select('person_type_id',$person_types,$person->person_type_id,['class'=>'select form-control','required', 'placeholder'=>'Seleccione Tipo']) !!}
                    </div>
				</div>
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::text('name', $person->name ,['class'=>'form-control','placeholder'=>'Nombre del Cliente','maxlength' => 30, 'requerid' ]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('document_number', 'Cédula/Ruc') !!}
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </span>
                            {!! Form::text('document_number',$person->document_number,['class'=>'form-control','placeholder'=>'Cédula/Ruc','maxlength' => 13, 'requerid' ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('phone', 'Teléfono') !!}
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <i class="fa fa-phone"></i>
                            </span>
                            {!! Form::text('phone',$person->phone,['class'=>'form-control','placeholder'=>'Teléfono','maxlength' => 10,'requerid' ]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('cell_phone', 'Celular') !!}
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <i class="fa fa-mobile"></i>
                            </span>
                            {!! Form::text('cell_phone',$person->cell_phone,['class'=>'form-control','placeholder'=>'Celular','maxlength' => 10, 'requerid' ]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('address', 'Dirección') !!}
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <i class="fal fa-address-card"></i>
                            </span>
                            {!! Form::text('address',$person->address,['class'=>'form-control','placeholder'=>'Dirección','maxlength' => 80,'requerid' ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="col-md-12">
                    <div class="form-group no-margin">
                        <button type="submit" class="btn btn-success">
                            <span class="fa fa-save"></span>
                            Editar
                        </button>
                    </div>
                </div>

            </div>
        {!! Form::Close() !!}
    </div>
</div>

@endsection
