@extends('plantilla.admin')
@section('contenido')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Articulos <a href="{!!URL::to('/almacen/articulo/create')!!}" class="btn btn-primary">Nuevo</a></h4>
                    @include('almacen.articulo.search')    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Codigo</th>
                                <th>Categoria</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($articulos as $articulo)                
                                <tr>
                                    <td>
                                        <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->nombre}}" width="40" height="40" class="img-thumbail">
                                    </td>
                                    <td>{{$articulo->nombre}}</td>
                                    <td>{{$articulo->codigo}}</td>
                                    <td>{{$articulo->categoria}}</td>
                                    <td>{{$articulo->stock}}</td>
                                    <td>{{$articulo->estado}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                        <a href="{{URL::action('ArticuloController@edit',$articulo->id)}}" class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i></a>  
                                        <a href="" data-target="#modal-delete-{{$articulo->id}}" data-toggle="modal" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>  
                                        </div>
                                    </td>
                                </tr>
                                @include('almacen.articulo.modal')
                                @endforeach                                
                            </tbody>
                        </table>

                  </div>  
                    <br>
                    <div class="col">
                        <nav aria-label="" class="d-flex justify-content-center">
                            {{$articulos->render()}}
                        </nav>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection