<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use laravelVue\Product;
use DB;
use MP;
use Carbon\Carbon;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Cart::content();
        return view('cart.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart=Cart::content();

        require_once "../vendor/mercadopago/sdk/lib/mercadopago.php";
        $mp = new MP ("1705553029705790", "GRjYlJNkVvkdIVcw3NWxF9fvrOqrj246");
        
    $preferenceData = [
    
        'payer'              => [
            'name' => 'pepe',
            'email' => 'mymail@gmail.com',
            'phone_number' => '46500539',
            'area_code' => '011',
            'extension' => null
        ],
	"back_urls" => array(
		"success" => "https://www.success.com",
		"failure" => "http://www.failure.com",
		"pending" => "http://www.pending.com"
	),
	"auto_return" => "approved",
        /*payment*/
        "payment_methods" => array(
		"excluded_payment_methods" => array(
			array(
				"id" => "rapipago",
			)
		),
        "excluded_payment_types" => array(
			array(
				"id" => "debit_card",
			)
		),
        ),
        /*formas de pago*/
    ];
    

    foreach (Cart::content() as $e):
        $preferenceData['items'][] = [
            'id'          => $e->id,
            'category_id' => 'zapato',
            'title'       => $e->name,
            'description' => 'esta es la descripción del zapato',
            'picture_url' => 'https://avatars0.githubusercontent.com/u/37180933?s=400&v=4',
            'quantity'    => $e->qty,
            'unit_price'  => $e->price,
            "currency_id" => "ARS",
            'start_date' => Carbon::now()->toDateTimeString(),
        ];
    endforeach;

    $preference = $mp->create_preference($preferenceData);

    // return init point to be redirected
    //return $preference['response']['init_point'];
    //return dd($preferenceData);
        return view('cart.create',compact('preference'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto=Product::find($id);
        Cart::add($id, $producto->nombre,1,$producto->precio, ['image' => $producto->imagen]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id,$request->qty);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back();
    }
}
