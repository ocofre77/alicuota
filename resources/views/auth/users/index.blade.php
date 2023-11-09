@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <!-- <h1 class="m-0 text-dark">Personas</h1>
	<div class="pull-right">
		<a href="{{url('Persons/create')}}" type="button" class="btn btn-primary">
			<i class="fa fa-plus" aria-hidden="true"></i> Agregar
		</a>
	</div> -->
@stop

@section('new_button')
@endsection

@section('content')

	<!-- Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Confirmar Borrado</h4>
          </div>

          <div class="modal-body">
            <p>Estás a punto de eliminar una persona, este procedimiento es irreversible.</p>
            <p>¿Quieres proceder?</p>
            <p class="debug-url"></p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger btn-ok">Borrar</a>
          </div>
        </div>
      </div>
    </div>	

    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Acción</th>
            </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name}}</td>
                <td>{{ $user->email}}</td>
                <td class="hidden-xs">{{ $user->id}}</td>
                <td>
            </tr>
            @endforeach
        </tbody>
        </table>
        {{ $users->appends(request()->input())->links() }}
    </div>


@endsection
@section('customScript')
<script type="text/javascript">
  $(document).ready(function(){
	  $("#person_type_id").on('change',function(){
	      $( "#frm_person_type" ).submit();
	  });
  });
</script>

@endsection
