@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nuevo articulo</h4> 
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
                    {!!Form::open(['route' => 'articulo.store', 'method' => 'POST','files'=>'true'])!!}
                    <div class="form-group">
                        {!!Form::label('Nombre: ')!!}
                        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre...','required','value'=>"{{old('nombre')}}"
                        ])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Categoria: ')!!}
                        <select name="idCategoria" class="custom-select">
                           <option selected>Seleccionar</option>
                            @foreach($categorias as $categoria)
                              <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        {!!Form::label('Codigo: ')!!}
                        {!!Form::text('codigo',null,['class'=>'form-control','placeholder'=>'Codigo...','value'=>"{{old('codigo')}}"])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Descripcion: ')!!}
                        {!!Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Descripicion...','value'=>"{{old('nombre')}}"])!!}
                    </div>
                     <div class="form-group">
                        {!!Form::label('Stock: ')!!}
                        {!!Form::number('stock',null,['class'=>'form-control','placeholder'=>'Stock...','value'=>"{{old('stock')}}"])!!}
                    </div>
                    <div class="form-group">
                        <label>Seleccionar imagen</label>
                        {!! Form::file('imagen',['class'=>'form-control-file']) !!}
                    </div>
                    <div class = "form-group">
                        <a href="{!!URL::to('almacen/articulo/')!!}" class="btn btn-danger">Cancelar</a>
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
