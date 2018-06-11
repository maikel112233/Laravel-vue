@extends('plantilla.admin')
@section('contenido')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ingresos <a href="{!!URL::to('/compras/ingreso/create')!!}" class="btn btn-primary">Nuevo</a></h4>
                    @include('compras.ingreso.search')    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Comprobante</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($ingresos as $ingreso)                
                                <tr>
                                    <td>{{$ingreso->fecha_hora}}</td>
                                    <td>{{$ingreso->nombre}}</td>
                                    <td>{{$ingreso->tipo_comprobante.': '.$ingreso->serie_comprobante.'-'.$ingreso->numero_comprobante}}</td>
                                    <td>{{$ingreso->impuesto}}</td>
                                    <td>{{$ingreso->total}}</td>
                                    <td>{{$ingreso->estado}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                        <a href="{{URL::action('IngresoController@show',$ingreso->id)}}" class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i></a>  
                                        <a href="" data-target="#modal-delete-{{$ingreso->id}}" data-toggle="modal" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>  
                                        </div>
                                    </td>
                                </tr>
                                @include('compras.ingreso.modal')
                                @endforeach                                
                            </tbody>
                        </table>

                  </div>  
                    <br>
                    <div class="col">
                        <nav aria-label="" class="d-flex justify-content-center">
                            {{$ingresos->render()}}
                        </nav>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection