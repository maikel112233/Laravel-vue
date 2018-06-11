@extends('plantilla.admin')
@section('contenido')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Usuario <a href="{!!URL::to('/seguridad/usuario/create')!!}" class="btn btn-primary">Nueva</a></h4>
                    @include('seguridad.usuario.search')    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)                
                                <tr>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                        <a href="{{URL::action('UsuarioController@edit',$usuario->id)}}" class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i></a>  
                                        <a href="" data-target="#modal-delete-{{$usuario->id}}" data-toggle="modal" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>  
                                        </div>
                                    </td>
                                </tr>
                                @include('seguridad.usuario.modal')
                                @endforeach                                
                            </tbody>
                        </table>

                  </div>  
                    <br>
                    <div class="col">
                        <nav aria-label="" class="d-flex justify-content-center">
                            {{$usuarios->render()}}
                        </nav>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection