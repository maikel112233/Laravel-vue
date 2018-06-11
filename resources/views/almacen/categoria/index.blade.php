@extends('plantilla.admin')
@section('contenido')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Categorias <a href="{!!URL::to('/almacen/categoria/create')!!}" class="btn btn-primary">Nueva</a></h4>
                    @include('almacen.categoria.search')    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($categorias as $categoria)                
                                <tr>
                                    <td>{{$categoria->nombre}}</td>
                                    <td>{{$categoria->descripcion}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                        <a href="{{URL::action('CategoriaController@edit',$categoria->id)}}" class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i></a>  
                                        <a href="" data-target="#modal-delete-{{$categoria->id}}" data-toggle="modal" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>  
                                        </div>
                                    </td>
                                </tr>
                                @include('almacen.categoria.modal')
                                @endforeach                                
                            </tbody>
                        </table>

                  </div>  
                    <br>
                    <div class="col">
                        <nav aria-label="" class="d-flex justify-content-center">
                            {{$categorias->render()}}
                        </nav>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection