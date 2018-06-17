@extends('welcome')
@section('cart')
    <br>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Cart items</h1>
                    <hr>
                    <table class="table table-hover">
                        <thead>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td><img src="{{asset('imagenes/t-shirt/'.$item->options->image )}}" alt="{{$item->name}}"></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td width="5px">
                                    {!!Form::open(['route'=>['cart.update',$item->rowId],'method'=>'put'])!!}
                                            <input name="qty" type="number" value="{{$item->qty}}" class="">
                                            <input type="submit" class="btn btn-default" value="ok">
                                    {!!Form::close()!!}
                                </td>
                                <td>{{$item->price*$item->qty}}</td>
                                <td>
                                    {!!Form::open(['route'=>['cart.destroy',
                                        $item->rowId],'method'=>'DELETE'])!!}
                                           {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td>Tax {{Cart::tax()}}</td>
                                <td>subTotal: ${{Cart::subtotal()}}</td>
                                <td>Total: ${{Cart::total()}}</td>
                            </tr>
                        </tfooter>
                    </table>
                    <a href="{{url('/welcome')}}" class="btn btn-danger">volver</a>
                    <a href="{{route('cart.create')}}" class="btn btn-success">Seguir</a>
                </div>
            </div>
        </div>
    </div>
@endsection