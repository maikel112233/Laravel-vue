{!!Form::open(array('url'=>'compras/proveedor',
    'method'=>'GET',
    'autocomplete'=>'off',
    'role'=>'searchText',
     'class'=>'form-inline my-2 my-lg-0'))!!}
     
      <input class="form-control mr-sm-2" type="text" placeholder="Buscar..." name="searchText" value="{{$searchText}}">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Buscar</button>
   
{{Form::close()}}