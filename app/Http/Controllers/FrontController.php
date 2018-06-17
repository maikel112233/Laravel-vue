<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use laravelVue\Product;

class FrontController extends Controller
{
    public function index(){
        $productos = Product::get();
        return view('index.index',compact('productos'));
    }
}
