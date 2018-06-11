<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\CategoriaRequest;
use Redirect;
use laravelVue\Categoria;
use DB;


class CategoriaController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categorias')
                ->where('nombre','LIKE','%'.$query.'%')
                ->where('condicion','=',1)
                ->orderBy('id','desc')
                ->paginate(7);
            return view('almacen.categoria.index',['categorias'=>$categorias,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacen.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = Categoria::create([
            'nombre'=>$request['nombre'],
            'descripcion'=>$request['descripcion'],
        ]);
        return Redirect::to('almacen/categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('almacen.categoria.show',['categoria'=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('almacen.categoria.edit',['categoria'=>Categoria::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->save();
        return Redirect::to('almacen/categoria');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
}
