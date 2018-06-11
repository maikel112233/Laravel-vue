@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nueva categoria</h4> 
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
                    @endif {!!Form::open(['route' => 'categoria.store', 'method' => 'POST'])!!}
                    <div class="form-group">
                        {!!Form::label('Nombre: ')!!}
                        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre...'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('Descripcion: ')!!}
                        {!!Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Descripicion...'])!!}
                    </div>
                    <div class = "form-group">
                        <a href="{!!URL::to('almacen/categoria/')!!}" class="btn btn-danger">Cancelar</a>
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
