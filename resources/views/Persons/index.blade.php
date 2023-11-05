
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Personas</h1>
	<div class="pull-right">
		<a href="{{url('Persons/create')}}" type="button" class="btn btn-primary">
			<i class="fa fa-plus" aria-hidden="true"></i> Agregar
		</a>
	</div>
@stop


@section('new_button')
@endsection


@section('content')
	<!-- Default box -->
	<div class="box box-success">
		<div class="box-header with-border">
			{!! Form::open([ 'method' =>'GET', 'class' => '','id' => 'frm_person_type']) !!}
				<div class="row">
					<div class="col-sm-2">
						{!! Form::select('person_type_id',$person_types,$person_type_id,
							[
								'class'=>'input-filter input-md form-control',
								'placeholder'=>'Seleccione Tipo',
								'onchange' => 'searchByPersonType(this.value);',
								'id' => 'person_type_id'
							])
						!!}
					</div>
					<div class="col-sm-4">
					<!-- Inicio Buscador por Nombre -->
						<div class ="input-group" >
							{!! Form::text('name',$person_name,['class'=> 'form-control input-md','placeholder'=>'Buscar Contacto..','aria-describedby'=>'search'])!!}
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<span class="btn-label"><i class="fa fa-search"></i></span>
								</button>
							</span>
						</div>
					</div>
					<!-- Fin Buscador -->
					<div class="col-sm-2">
					<!-- Inicio Buscador por Documento -->
						<div class ="input-group" >
							{!! Form::text('document_number',$document_number,['class'=> 'form-control input-md','placeholder'=>'Nro. Documento..','aria-describedby'=>'searchByNumber'])!!}
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</div>
					<!-- Fin Buscador -->
				</div>
				{!! Form::close() !!}
		</div>
		    <!-- /.box-header -->


	    <div class="box-body">
	          <table class="table table-bordered table-hover">
              <thead>
				<th>Tipo</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th class="hidden-xs">Teléfono</th>
                <th>Celular</th>
                <th class="hidden-xs" >Dirección</th>
                <th>Acción</th>
              </thead>
              <tbody>
                @foreach ($persons as $person)
                  <tr>
					  <td>{{ $person->personType->name }}</td>
                      <td>{{ $person->name}}</td>
                      <td>{{ $person->document_number}}</td>
                      <td class="hidden-xs">{{ $person->phone }}</td>
                      <td>{{ $person->cell_phone }}</td>
                      <td class="hidden-xs">{{ $person->address}}</td>
                      <td>
						   @permission('edit-auth-persons')
							<a alt="Editar" href="{{ route('Persons.edit', $person->id )}}" type="button" class="btn btn-xs btn-warning">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</a>
							@endpermission
							<a alt="Propiedades" href="{{ route('Properties.index', [ 'id' => $person->id] )}}" type="button" class="btn btn-xs btn-info ">
								<i class="fa fa-home" aria-hidden="true"></i>
							</a>
							@permission('delete-auth-persons')
							<a href="" alt="Borrar" type="button"
								data-href="{{ route('Persons.destroy', $person->id )}}"
								class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#confirm-delete">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
							@endpermission
                      </td>
                  </tr>
                @endforeach
              </tbody>
          	  </table>
		  <!-- Paginado -->
	      {{ $persons->appends(request()->input())->links() }}
		 <!-- Fin Paginado -->
		<!-- /.box-body -->
		</div>
	<!-- /.box -->
    </div>


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
