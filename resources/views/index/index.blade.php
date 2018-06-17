@extends('welcome')
@section('cart')
<div class="row">
    <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">Carrito demo</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="{{route('cart.index')}}" role="button">{{Cart::count()}}<span class="mdi mdi-cart-outline"></span> mi carrito</a>
        </div>
    </div>
</div>

<div class="row text-white text-center">
    @foreach($productos as $producto)
    <div class="col-md-4">
        <h3>{{$producto->nombre}}</h3>
        <img src="{{asset('imagenes/t-shirt/'.$producto->imagen)}}" alt="{{$producto->nombre}}" class="img-thumbnail">
        <p class="nav-link">{{$producto->link}}</p>
        <span class="badge badge-success"><h4>$ {{$producto->precio}}</h4></span>
        {!!link_to_route('cart.edit', $title = 'Add',    $parameters = [$producto->id], $attributes = ['class'=>'btn btn-danger mdi mdi-cart']);!!}
    </div>
    @endforeach
</div>
<br>
@endsection