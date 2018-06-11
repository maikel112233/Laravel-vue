@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nuevo ingreso</h4> 
                <hr>
                <div class="col-lg-12 col-md-12 col-xs-12">

                        <div class="form-group">
                            {!!Form::label('Cliente: ')!!}
                            <p>{{$venta->nombre}}</p>
                        </div>    
                        <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                {!!Form::label('Tipo Comprobante: ')!!}
                                <p>{{$venta->tipo_comprobante}}</p>
                            </div>  
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                {!!Form::label('Serie Comprobante: ')!!}
                                <p>{{$venta->serie_comprobante}}</p>
                            </div>  
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                {!!Form::label('Num Comprobante: ')!!}
                                <p>{{$venta->numero_comprobante}}</p>
                            </div>  
                        </div>
                    </div>
                        <div class="panel panel-primary" style="width:100%">
                            <div class="panel-body" style="width:100%">
                            <div class="col">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead class="thead-light">
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                        <th>P. Venta</th>
                                        <th>Descuento</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                       @foreach($detalles as $detalle)
                                           <tr>
                                               <td>{{$detalle->articulo}}</td>
                                               <td>{{$detalle->cantidad}}</td>
                                               <td>{{$detalle->venta}}</td>
                                               <td>{{$detalle->descuento}}</td>
                                               <td>{{$detalle->cantidad*$detalle->venta-$detalle->descuento}}</td>
                                           </tr>
                                       @endforeach 
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h4 id="total">{{$venta->total_venta}}</h4></th>
                                    </tfoot>    
                                </table>
                            </div>
                            <br>
                            </div>    
                        </div>

                    <div class = "form-group" id="guardar">
                        <a href="{!!URL::to('ventas/venta/')!!}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>

            </div>
            <!--cardbody-->
        </div>
    </div>
</div>
@endsection