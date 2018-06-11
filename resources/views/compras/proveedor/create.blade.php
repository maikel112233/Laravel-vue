@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nuevo proveedor</h4> 
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
                    {!!Form::open(['route' => 'proveedor.store', 'method' => 'POST'])!!}
                    <div class="form-group">
                        {!!Form::label('Nombre: ')!!}
                        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre...','required','value'=>"{{old('nombre')}}"
                        ])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Tipo Doc: ')!!}
                        <select name="tipo_doc" class="custom-select">
                                <option selected>Seleccionar</option>
                                <option value="dni">Dni</option>
                                <option value="libreta">Libreta</option>
                                <option value="pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {!!Form::label('Numero Doc: ')!!}
                        {!!Form::number('numero_doc',null,['class'=>'form-control','placeholder'=>'Numero documento...','required','value'=>"{{old('numero_doc')}}"
                        ])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Direcion: ')!!}
                        {!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Direccion...','value'=>"{{old('direccion')}}"])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Telefono: ')!!}
                        {!!Form::number('telefono',null,['class'=>'form-control','placeholder'=>'Telefono...','value'=>"{{old('telefono')}}"])!!}
                    </div>
                     <div class="form-group">
                        {!!Form::label('Email: ')!!}
                        {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email...','value'=>"{{old('email')}}"])!!}
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
