@extends('adminlte::page')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title')
    Datos Empresa
@endsection
@section('content')
<div class="main_container">
	<div class="box box-success">
	    {!! Form::Open(['route' => ['Companies.update',$company],'method' => 'PUT']) !!}

			<div class="box-body">
				<div class="col-md-12">
				    <div class="form-group">
				        {!! Form::label('name', 'Nombre de la Empresa') !!}
				        {!! Form::text('name', $company->name ,['class'=>'form-control','placeholder'=>'Nombre de la Empresa','maxlength' => 50, 'requerid' ]) !!}
				    </div>
				</div>

		        <div class="col-md-4">
		            <div class="form-group">
		                {!! Form::label('ruc', 'Ruc') !!}
		                <div class="input-group">
		                    <span class="input-group-addon" id="sizing-addon2">
		                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
		                    </span>
		                    {!! Form::text('ruc',$company->ruc,['class'=>'form-control','placeholder'=>'Ruc','maxlength' => 13, 'requerid' ]) !!}
		                </div>
		            </div>
		        </div>
				<div class="col-md-4">
		            <div class="form-group">
		                {!! Form::label('email', 'Email') !!}
		                <div class="input-group">
		                    <span class="input-group-addon" id="sizing-addon2">
		                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
		                    </span>
		                    {!! Form::text('email',$company->email,['class'=>'form-control','placeholder'=>'Email','maxlength' => 120, 'requerid' ]) !!}
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
		                    {!! Form::text('phone',$company->phone,['class'=>'form-control','placeholder'=>'Teléfono','maxlength' => 10, 'requerid' ]) !!}
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
		                    {!! Form::text('address',$company->address,['class'=>'form-control','placeholder'=>'Dirección','maxlength' => 80, 'requerid' ]) !!}
		                </div>
		            </div>
		        </div>


	        </div>


			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" class="btn btn-success" >
					<i class="fa fa-save"></i>  Grabar
				</button
			</div>
		</div>

        {!! Form::Close() !!}
	</div>

@endsection
