@extends('adminlte::page')

@section('contentheader_title')
	<!-- {{ trans('adminlte_lang::message.home') }}
	 -->
	 Datos Urbanización
@endsection

@section('contentheader_description')

@endsection

@section('new_button')
@endsection

@section('content')
		<!-- Default box -->
<div class="box box-success">
      	<div class="box-body">

					@if( $companies->count() > 0)
					<table class="table table-bordered table-hover">
					    <thead>
  					    <th>Nombre</th>
  						  <th>RUC</th>
                <th>Correo</ht>
  					    <th>Teléfono</th>
  						  <th>Dirección</th>
  						  <th>Acciones</th>
					    </thead>
					    <tbody>
					      @foreach ($companies as $company)
				        <tr>
			              <td>{{ $company->name}}</td>
						        <td>{{ $company->ruc}}</td>
			              <td>{{ $company->email}}</td>
                    <td>{{ $company->phone }}</td>
  								  <td>{{ $company->address }}</td>
  								  <td>
  									  <a href="{{ route('Companies.edit', [$company->id ])}}" type="button" class="btn btn-xs btn-warning">
  										  <i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
  								  </td>
				          </tr>
					      @endforeach
						</tbody>
					</table>

					@endif


    	</div>
		<!-- /.box-body -->
</div>
		<!-- /.box -->

@endsection
