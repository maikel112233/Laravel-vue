@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modificar usuario <span class="text-success">{{$usuario->nombre}}</span></h4>
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
                    {!!Form::model($usuario,['route'=>['usuario.update',
	                    $usuario->id],'method'=>'PUT'])!!}
	                    
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Nombre</label>

                        <div class="col">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" required autofocus> @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col control-label">E-Mail</label>

                        <div class="col">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email}}" required> @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col control-label">Password</label>

                        <div class="col">
                            <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col control-label">Confirmar Password</label>

                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class = "form-group">
                        <a href="{!!URL::to('seguridad/usuario/')!!}" class="btn btn-danger">Cancelar</a>
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
