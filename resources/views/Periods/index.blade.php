
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Personas</h1>
	<div class="pull-right">
		<a href="{{url('Persons/create')}}" type="button" class="btn btn-primary">
			<i class="fa fa-plus" aria-hidden="true"></i> Agregar
		</a>
	</div>
@endsection

@section('content')

<div class="row">
	<!-- left column -->
	<div class="col-md-6">
		<!-- Default box -->
		<div class="box box-success">
			<div class="box-header with-border">
				{!! Form::open(['route'=>'Periods.store','method' =>'POST']) !!}
				<button type="submit" class="btn btn-success">
					<i class="fa fa-plus" aria-hidden="true"></i> Agregar
				</button>

					{!! Form::close() !!}
			</div>
				<!-- /.box-header -->
			<div class="box-body">
				<!-- /.box-body -->
				@if( $periods->count() > 0)
				<table class="table table-bordered table-hover">
					<thead>
						<th>Año</th>
					</thead>
					<tbody>
							@foreach ($periods as $period)
									<tr>
											<td>{{ $period->year}}</td>
									</tr>
							@endforeach
					</tbody>
				</table>
				@endif
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>

@endsection

@section('js')

@endsection
