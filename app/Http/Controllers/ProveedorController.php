<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\PersonaRequest;
use Redirect;
use laravelVue\Persona;
use DB;

class ProveedorController extends Controller
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
            $personas=DB::table('personas')
                ->where('nombre','LIKE','%'.$query.'%')
                ->where('tipo','=','Proveedor')
                ->orWhere('numero_doc','LIKE','%'.$query.'%')
                ->where('tipo','=','Proveedor')
                ->orderBy('nombre','asc')
                ->paginate(7);
            return view('compras.proveedor.index',['personas'=>$personas,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compras.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request)
    {
        $persona = Persona::create([
            'nombre'=>$request['nombre'],
            'tipo'=>'Proveedor',
            'tipo_doc'=>$request['tipo_doc'],
            'numero_doc'=>$request['numero_doc'],
            'direccion'=>$request['direccion'],
            'telefono'=>$request['telefono'],
            'email'=>$request['email'],
        ]);
        return Redirect::to('compras/proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('compras.proveedor.show',['persona'=>Persona::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('compras.proveedor.edit',['persona'=>Persona::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaRequest $request, $id)
    {
        $persona = Persona::find($id);
        $persona->fill($request->all());
        $persona->update();
        return Redirect::to('compras/proveedor');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->tipo='Inactivo';
        $persona->update();
        return Redirect::to('compras/proveedor');
    }
}
