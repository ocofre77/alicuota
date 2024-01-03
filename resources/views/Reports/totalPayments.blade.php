
@extends('adminlte::page')

@section('title', 'Prados Condado')

@section('content_header')
	 Reporte Pagos Final
@endsection

@section('content')
<div class="card">
	<div class="card-header ">

{!! Form::Open(['route' => ['Reports.exportPayments'],'method' => 'GET']) !!}
		<div class="row">
			<div class="col-md-4">
				{!! Form::label('year', 'Año:') !!}
	            {!! Form::select('year',$years,null,['class'=>'input-filter input-sm form-control','placeholder'=>'Año']) !!}
			</div>
			<div class="col-md-4">
				{!! Form::label('person_type_id', 'Residente:') !!}
				{!! Form::select('person_type_id',$person_types,null,['class'=>'input-filter input-sm form-control', 'placeholder'=>'Seleccione Tipo']) !!}
			</div>
			<div class="col-md-4">
				<button type="submit" class="btn btn-success buttons-excel" name="button">
					<span class="align-text-bottom">
						<i class="fa fa-file-excel-o"></i> Excel
					</span>
				</button>
			</div>
		</div>

{!! Form::Close() !!}

	</div>
    <div class="card-body">
        {{-- {!! $dataTable->table(['class' => 'table table-bordered table-condensed']) !!} --}}
		{{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('css')

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
	
@endpush

@section('js')

	{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


@endsection
