@extends('plantilla.admin')
@section('contenido')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ventas <a href="{!!URL::to('/ventas/venta/create')!!}" class="btn btn-primary">Nuevo</a></h4>
                    @include('ventas.venta.search')    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Comprobante</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($ventas as $venta)                
                                <tr>
                                    <td>{{$venta->fecha_hora}}</td>
                                    <td>{{$venta->nombre}}</td>
                                    <td>{{$venta->tipo_comprobante.': '.$venta->serie_comprobante.'-'.$venta->numero_comprobante}}</td>
                                    <td>{{$venta->impuesto}}</td>
                                    <td>{{$venta->total_venta}}</td>
                                    <td>{{$venta->estado}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                        <a href="{{URL::action('VentaController@show',$venta->id)}}" class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i></a>  
                                        <a href="" data-target="#modal-delete-{{$venta->id}}" data-toggle="modal" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>  
                                        </div>
                                    </td>
                                </tr>
                                @include('ventas.venta.modal')
                                @endforeach                                
                            </tbody>
                        </table>

                  </div>  
                    <br>
                    <div class="col">
                        <nav aria-label="" class="d-flex justify-content-center">
                            {{$ventas->render()}}
                        </nav>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection