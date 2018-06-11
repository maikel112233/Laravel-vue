@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modificar articulo <span class="text-success">{{$articulo->nombre}}</span></h4>
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
                    {!!Form::model($articulo,['route'=>['articulo.update',
	                    $articulo->id],'method'=>'PUT','files'=>'true'])!!}
                     <div class="form-group">
                        {!!Form::label('Nombre: ')!!}
                        {!!Form::text('nombre',null,['class'=>'form-control','required','value'=>"{{articulo->nombre)}}"
                        ])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Categoria: ')!!}
                        <select name="idCategoria" class="custom-select">
                            @foreach($categorias as $categoria)  
                                @if($categoria->id==$articulo->idCategoria)
                                   <option value="{{$categoria->id}}" selected>    {{$categoria->nombre}}
                                   </option>
                                @else
                                <option value="{{$categoria->id}}">    {{$categoria->nombre}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!!Form::label('Codigo: ')!!}
                        {!!Form::text('codigo',null,['class'=>'form-control','value'=>"{{old('codigo')}}"])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Descripcion: ')!!}
                        {!!Form::textarea('descripcion',null,['class'=>'form-control','value'=>"{{old('nombre')}}"])!!}
                    </div>
                     <div class="form-group">
                        {!!Form::label('Stock: ')!!}
                        {!!Form::number('stock',null,['class'=>'form-control','value'=>"{{old('stock')}}"])!!}
                    </div>
                    <div class="form-group">
                        <label>Seleccionar imagen</label>
                        {!! Form::file('imagen',['class'=>'form-control-file']) !!}
                        @if(($articulo->imagen)!="")
                            <div class="d-inline-flex">
                                <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->imagen}}" width="40" height="40" class="img-thumbail">
                                <p class="text-muted text-muted-form-imagen">imagen actual</p>
                            </div>
                        @endif                    
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
