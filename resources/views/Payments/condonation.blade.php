@extends('adminlte::layouts.app')

@section('contentheader_title')
	 Registro de Condonacion
@endsection

@section('main-content')
		<div class="row">
		        <!-- left column -->
		        <div class="col-md-12">
			    	<div class="box box-success">
							{!! Form::open(['route'=>'Payments.condonation', 'method' =>'GET']) !!}
			 			<div class="box-body">

									<div class="col-md-8">
										<div class="input-group">
											{!! Form::label('person_name', 'Nombre') !!}
										  {!! Form::text('person_name',null,['class'=> 'form-control','placeholder'=>'Nombre','maxlength' => 30,'aria-describedby'=>'search'])!!}

										</div>
									</div>



											<div class="col-md-4">
												<div class="input-group">
													{!! Form::label('lot_number', 'Lote') !!}
													{!! Form::text('lot_number',null,['class'=> 'form-control','placeholder'=>'0','maxlength' => 3,'aria-describedby'=>'search'])!!}
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													{!! Form::label('note', 'Nota') !!}
													<div class="input-group">
														<span class="input-group-addon" id="sizing-addon2">
															<i class="fa fa-envelope-o" aria-hidden="true"></i>
														</span>
														{!! Form::text('note',null,['class'=>'form-control','placeholder'=>'Nota','maxlength' => 60, 'requerid' ]) !!}
													</div>
												</div>
											</div>





							{!! Form::close() !!}
			    	</div>
          </div>
	</div>
	</div>


  </script>
@endsection
