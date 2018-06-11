@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modificar proveedor <span class="text-success">{{$persona->nombre}}</span></h4>
                <hr>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    @if(count($errors)>0)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li><strong>{{$error}}</strong></li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif 
                    {!!Form::model($persona,['route'=>['proveedor.update',
	                    $persona->id],'method'=>'PUT'])!!}
                     <div class="form-group">
                        {!!Form::label('Nombre: ')!!}
                        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre...','required','value'=>"{{$persona->nombre}}"
                        ])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Tipo Doc: ')!!}
                        <select name="tipo_doc" class="custom-select">
                                @if($persona->tipo=='dni')
                                    <option value="dni" selected>Dni</option>
                                    <option value="libreta" >Libreta</option>
                                    <option value="pasaporte">Pasaporte</option>
                                @elseif($persona->tipo=='libreta')
                                    <option value="dni">Dni</option>
                                    <option value="libreta" selected>Libreta</option>
                                    <option value="pasaporte">Pasaporte</option>
                                @else
                                    <option value="dni">Dni</option>
                                    <option value="pasaporte" selected>Pasaporte</option>
                                    <option value="libreta" >Libreta</option>
                                @endif
                        </select>
                    </div>
                    <div class="form-group">
                        {!!Form::label('Numero Doc: ')!!}
                        {!!Form::number('numero_doc',null,['class'=>'form-control','placeholder'=>'Numero documento...','required','value'=>"{{old('numero_doc')}}"
                        ])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Direcion: ')!!}
                        {!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Direccion...','value'=>"$persona->direccion"])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Telefono: ')!!}
                        {!!Form::number('telefono',null,['class'=>'form-control','placeholder'=>'Telefono...','value'=>"$persona->telefono"])!!}
                    </div>
                     <div class="form-group">
                        {!!Form::label('Email: ')!!}
                        {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email...','value'=>"$persona->email"])!!}
                    </div>

                    <div class = "form-group">
                        <a href="{!!URL::to('compras/proveedor/')!!}" class="btn btn-danger">Cancelar</a>
                       {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>

            </div>
            <!--cardbody-->
        </div>
    </div>
</div>
@endsection
