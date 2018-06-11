@extends('plantilla.admin')
@section('contenido')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Proveedor <a href="{!!URL::to('/compras/proveedor/create')!!}" class="btn btn-primary">Nuevo</a></h4>
                    @include('compras.proveedor.search')    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Nombre</th>
                                <th>Tipo Doc.</th>
                                <th>Numero Doc.</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($personas as $persona)                
                                <tr>
                                    <td>{{$persona->nombre}}</td>
                                    <td>{{$persona->tipo_doc}}</td>
                                    <td>{{$persona->numero_doc}}</td>
                                    <td>{{$persona->telefono}}</td>
                                    <td>{{$persona->email}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                        <a href="{{URL::action('ProveedorController@edit',$persona->id)}}" class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i></a>  
                                        <a href="" data-target="#modal-delete-{{$persona->id}}" data-toggle="modal" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>  
                                        </div>
                                    </td>
                                </tr>
                                @include('compras.proveedor.modal')
                                @endforeach                                
                            </tbody>
                        </table>

                  </div>  
                    <br>
                    <div class="col">
                        <nav aria-label="" class="d-flex justify-content-center">
                            {{$personas->render()}}
                        </nav>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection