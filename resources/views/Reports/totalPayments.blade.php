@extends('adminlte::layouts.app')

@section('contentheader_title')
	 Reporte Pagos
@endsection

@section('main-content')
<div class="box">
	<div class="box-header ">

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
    <div class="box-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-condensed']) !!}
    </div>

</div>
@endsection

@section('customScript')

<!-- <link rel="stylesheet" href="/vendor/datatables//buttons.dataTables.min.css"> -->

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> -->
<!--
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js" ></script> -->
<!-- <script src="/vendor/datatables/buttons.server-side.js"></script> -->

{!! $dataTable->scripts() !!}


<script type="text/javascript">

  $(document).ready(function () {

		$('#year').on('change', function(e) {
		  $('#dataTableBuilder').DataTable().draw();
		});

		$('#person_type_id').on('change', function(e) {
		  $('#dataTableBuilder').DataTable().draw();
		});

		$('#dataTableBuilder').DataTable().on('preXhr.dt', function ( e, settings, data ) {
		  data.year = $('#year').val();
		  data.person_type_id = $('#person_type_id').val();
		});


  });
</script>

@endsection
