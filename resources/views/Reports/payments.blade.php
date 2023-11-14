
@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('contentheader_title')
	 Reportes de Pagos
@endsection

@section('contentheader_description')

@endsection

@section('content')
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
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Lote</th>
            <th>Valor</th>
            <th>Año</th>
            <th>Mes</th>
        </tr>
        </thead>
    </table>
</div>



@endsection

@section('customScript')


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


<!--
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js" ></script>
<script ser="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script ser="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script ser="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script ser="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script ser="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script> -->


<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


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
			 	             url: '{{ route("Reports.paymentsData") }}',
			 	             data: function (d) {
			 	                 d.year = $('select[name=year]').val();
			 	                 d.person_type_id = $('select[name=person_type_id]').val();
			 	             }
			 	         },
			 			 'language' : {
			                  "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			              },
			 		     columns: [
			 		         { data: 'person_name', name: 'persons.name'},
			 		         { data: 'person_type_name', name: 'person_types.name' },
			 		         { data: 'lot_number', name: 'properties.lot_number' },
			 		         { data: 'value', name: 'payments.value'},
			 		         { data: 'year', name: 'periods.year'},
			 		         { data: 'month_name', name:'periods.month_name'},
			 		     ]
			 		 });


			 	     $('#search-form').on('submit', function(e) {
			 	         oTable.draw();
			 	         e.preventDefault();
			 	     });


		 } );


	 </script>
@endsection
