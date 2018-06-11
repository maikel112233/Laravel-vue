@extends('plantilla.admin') @section('contenido')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nuevo venta</h4> 
                <hr>
                <div class="col-lg-12 col-md-12 col-xs-12">
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
                    {!!Form::open(['route' => 'venta.store', 'method' => 'POST'])!!}
                        <div class="form-group">
                            {!!Form::label('Cliente: ')!!}
                            <select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
                                @foreach($personas as $persona)
                                    <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                                @endforeach
                            </select>
                        </div>    
                        <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                {!!Form::label('Tipo Comprobante: ')!!}
                                <select name="tipo_comprobante" class="form-control">
                                    <option value="Boleta">Boleta</option>
                                    <option value="Factura">Factura</option>
                                    <option value="Ticket">Ticket</option>
                                </select>
                            </div>  
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                {!!Form::label('Serie Comprobante: ')!!}
                                {!!Form::number('serie_comprobante',null,['class'=>'form-control','placeholder'=>'Serie Comprobante...','value'=>"{{old('serie_comprobante')}}"])!!}
                            </div>  
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                {!!Form::label('Num Comprobante: ')!!}
                                {!!Form::number('numero_comprobante',null,['class'=>'form-control','placeholder'=>'Numero Comprobante...','value'=>", 'required' {{old('numero_comprobante')}}"])!!}
                            </div>  
                        </div>
                    </div>
                        <div class="panel panel-primary" style="width:100%">
                            <div class="panel-body" style="width:100%">
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        {!!Form::label('Articulo: ')!!}
                                        <select name="id_articulo" class="form-control selectpicker"   data-live-search="true" id="pidarticulo">
                                           @foreach($articulos as $articulo)
                                            <option value="{{$articulo->id}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">
                                                {{$articulo->articulo}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        {!!Form::label('Cantidad: ')!!}
                                        {!!Form::number('cantidad',null,['class'=>'form-control','id'=>'pcantidad'])!!}
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        {!!Form::label('Precio Venta: ')!!}
                                        {!!Form::number('precio_venta',null,['class'=>'form-control', 'id'=>'pprecio_venta','disabled'])!!}
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        {!!Form::label('Descuento: ')!!}
                                        {!!Form::number('descuento',null,['class'=>'form-control','id'=>'pdescuento'])!!}
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        {!!Form::label('Stock: ')!!}
                                        {!!Form::number('stock',null,['class'=>'form-control','id'=>'pstock','disabled'])!!}
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                       <button type="button" id="bt_add" class="btn btn-success">Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead class="thead-light">
                                        <th>Opciones</th>
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                        <th>P. Venta</th>
                                        <th>Descuento</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h4 id="total">$/. 0.00</h4>
                                            <input type="hidden" name="total_venta" id="total_venta">
                                        </th>
                                    </tfoot>    
                                </table>
                            </div>
                            <br>
                            </div>    
                        </div>

                    <div class = "form-group" id="guardar">
                        <a href="{!!URL::to('ventas/venta/')!!}" class="btn btn-danger">Cancelar</a>
                       {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>

            </div>
            <!--cardbody-->
        </div>
    </div>
</div>
<!-- scripts-->
@push('scripts')
<script>
    $(document).ready(function(){
        $('#bt_add').click(function(){
           agregar(); 
        });
    });
    
    var cont=0;
    total=0;
    subtotal=[];
    $("#guardar").hide();
    $("#pidarticulo").change(mostrarValores);
    
    function mostrarValores(){
        datosArticulo=document.getElementById('pidarticulo').value.split('_');
        $("#pprecio_venta").val(datosArticulo[2]);
        $("#pstock").val(datosArticulo[1]);
    }
    

    function agregar(){
        datosArticulo=document.getElementById('pidarticulo').value.split('_');
        idarticulo=datosArticulo[0];
        articulo=$("#pidarticulo option:selected").text();
        cantidad=parseInt($("#pcantidad").val());
        descuento=$("#pdescuento").val();
        precio_venta=$("#pprecio_venta").val();
        stock=$("#pstock").val();
        if(idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!=""){
            if(stock>=cantidad){
                subtotal[cont]=(cantidad*precio_venta-descuento);
                total=total+subtotal[cont];
                var fila='<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
                cont++;
                limpiar();
                $("#total").html("$/. "+total);
                $("#total_venta").html(total);
                document.getElementById("total_venta").value = total;
                evaluar("#total_venta");
                $("#detalles").append(fila);
            }
            else{
                alert('la cantidad a vender supera el stock');
            }
            
        }else{
            alert("Error al ingresar el detalle de la venta");
        }
    }
    
    function limpiar(){
        $("#pcantidad").val("");
        $("#pdescuento").val("");
        $("#pprecio_venta").val("");
    }
    function evaluar(){
        if(total>0){$("#guardar").show();}
        else{$("#guardar").hide();}
    }
    
    function eliminar(index){
        total=total-subtotal[index];
        $("#total").html("$/. "+total);
         $("#total_venta").html(total);
        $("#fila" + index).remove();
        evaluar();
    }
</script>
@endpush
@endsection