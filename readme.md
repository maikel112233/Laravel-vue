<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About

## Trigger

*
use ventasLaravelVue;

DELIMITER //
create trigger tr_upStockIngreso after insert on detalles_ingresos
for each row begin
update articulos set stock = stock + new.cantidad
where articulos.id = new.id_articulo;
end
//
DELIMITER ;

*
DELIMITER //
create trigger tr_upStockVenta after insert on detalles_ventas
for each row begin
update articulos set stock = stock - new.cantidad
where articulos.id = new.id_articulo;
end
//
DELIMITER ;

## shopingcart

    composer require gloudemans/shoppingcart
    
* config app
    Package Service Providers...
    Gloudemans\Shoppingcart\ShoppingcartServiceProvider::class,
    
    Class Aliases
    'Cart' => Gloudemans\Shoppingcart\Facades\Cart::class,

* php amake:controller CartController --resource
    Route::resource('cart','CartController');
    
*   En el controlador
    use Gloudemans\Shoppingcart\Facades\Cart;

    public function index()
    {
        $items=Cart::content();
        return view('cart.index',compact('items'));
    }

    public function edit($id)
    {
        $producto=Product::find($id);
        Cart::add($id, $producto->nombre,1,$producto->precio);
        return back();
    }
    
    public function update(Request $request, $id)
    {
        Cart::update($id,$request->qty);
        return back();
    }

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
