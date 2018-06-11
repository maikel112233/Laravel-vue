<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\ArticuloRequest;
use Redirect;
use Illuminate\Support\Facades\Input;
use laravelVue\Categoria;
use laravelVue\Articulo;
use DB;

class ArticuloController extends Controller
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
            $articulos=DB::table('articulos as a')
                ->JOIN('categorias as c','a.idCategoria','=','c.id')
                ->SELECT('a.id','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
                ->WHERE('a.nombre','LIKE','%'.$query.'%')
                ->orWHERE('a.codigo','LIKE','%'.$query.'%')
                ->orderBy('a.id','desc')
                ->paginate(7);
            return view('almacen.articulo.index',['articulos'=>$articulos,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=DB::table('categorias')->where('condicion','=','1')->get();
        return view('almacen.articulo.create',['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloRequest $request)
    {
        $articulo = new Articulo;
        $articulo->idCategoria=$request->get('idCategoria');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->estado='Activo';
            if(Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/articulos',$file->getClientOriginalName());
                $articulo->imagen=$file->getClientOriginalName();

            }
        $articulo->save();
        return Redirect::to('almacen/articulo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('almacen.articulo.show',['articulo'=>Articulo::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categorias')->where('condicion','=','1')->get();
        return view('almacen.articulo.edit',['articulo'=>$articulo,'categorias'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloRequest $request, $id)
    {
        $articulo = Articulo::find($id);
        $articulo->idCategoria=$request->get('idCategoria');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
            if(Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/articulos',$file->getClientOriginalName());
                $articulo->imagen=$file->getClientOriginalName();

            }
        $articulo->update();
        return Redirect::to('almacen/articulo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
