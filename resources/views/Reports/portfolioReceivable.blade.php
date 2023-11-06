@extends('adminlte::layouts.app')

@section('contentheader_title')
	 Reporte Cartera por Cobrar
@endsection

@section('contentheader_description')

@endsection

@section('main-content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="box">
    <div class="panel-body">
        <form method="POST" id="search-form" class="form-inline" role="form">

            {!! Form::label('year', 'Año:') !!}
            <div class="input-group date">
                {!! Form::select('year',$years,null,['class'=>'select form-control','placeholder'=>'Año']) !!}
            </div>

            <label for="person_type_id">Residente:</label>
			{!! Form::select('person_type_id',$person_types,null,['class'=>'select form-control', 'placeholder'=>'Seleccione Tipo']) !!}

            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <table class="table table-bordered" id="payments-table">
        <thead>
        <tr>
			<th>Lote</th>
			<th>Año</th>
			<th>Nombre</th>
			<th>Tipo</th>
            <th>Desde</th>
			<th>Hasta</th>
			<th>ENE</th>
			<th>FEB</th>
			<th>MAR</th>
			<th>ABR</th>
			<th>MAY</th>
			<th>JUN</th>
			<th>JUL</th>
			<th>AGO</th>
			<th>SEP</th>
			<th>OCT</th>
			<th>NOV</th>
			<th>DIC</th>
            <th>Valor</th>
			<th>Deuda</th>
        </tr>
        </thead>
    </table>

</div>



@endsection

@section('customScript')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script src="/vendor/datatables/buttons.server-side.js"></script>

	<script type="text/javascript">
	 $(document).ready(function() {

		var oTable = $('#payments-table').DataTable({
			// dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
	        //     "<'row'<'col-xs-12't>>"+
	        //     "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
					dom: 'Bfrtip',
		   			buttons: [ 'csv', 'excel', 'pdf', 'print' ],
		     processing: true,
		     serverSide: true,
			 ajax: {
	             url: '{{ route("Reports.portfolioReceivableData") }}',
	             data: function (d) {
	                 d.year = $('select[name=year]').val();
	                 d.person_type_id = $('select[name=person_type_id]').val();
	             }
	         },
			// "bFilter": false,
			 'language' : {
                 "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
             },
			// "order": [[ 0, "asc" ],[ 2, "asc" ]],
		     columns: [
				 { data: 'lot_number', name: 'lot_number' },
				 { data: 'year', name: 'year'},
				 { data: 'person_name', name: 'person_name'},
				 { data: 'person_type_name', name: 'person_type_name' },
				 { data: 'date_from', name: 'date_from'},
				 { data: 'date_to', name: 'date_to'},
				 { data: 'ENE', name:'ENE'},
				 { data: 'FEB', name:'FEB'},
				 { data: 'MAR', name:'MAR'},
				 { data: 'ABR', name:'ABR'},
				 { data: 'MAY', name:'MAY'},
				 { data: 'JUN', name:'JUN'},
				 { data: 'JUL', name:'JUL'},
				 { data: 'AGO', name:'AGO'},
				 { data: 'SEP', name:'SEP'},
				 { data: 'OCT', name:'OCT'},
				 { data: 'NOV', name:'NOV'},
				 { data: 'DIC', name:'DIC'},
		         { data: 'TOTAL', name: 'TOTAL'},
				 { data: 'DEUDA', name: 'DEUDA'},
		     ],
			 "columnDefs": [
		      { className: "dt-right", "targets": [0,2,5,6] },
		      { className: "dt-nowrap", "targets": [1,3,4] }
		    ]
		 });

	     $('#search-form').on('submit', function(e) {
	         oTable.draw();
	         e.preventDefault();
	     });
	});

	 </script>
@endsection
