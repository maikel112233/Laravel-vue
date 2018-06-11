<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\PersonaRequest;
use Redirect;
use laravelVue\Persona;
use DB;

class ClienteController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $personas=DB::table('personas')
                ->where('nombre','LIKE','%'.$query.'%')
                ->where('tipo','=','Cliente')
                ->orWhere('numero_doc','LIKE','%'.$query.'%')
                ->where('tipo','=','Cliente')
                ->orderBy('nombre','asc')
                ->paginate(7);
            return view('ventas.cliente.index',['personas'=>$personas,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ventas.cliente.create');
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
            'tipo'=>'Cliente',
            'tipo_doc'=>$request['tipo_doc'],
            'numero_doc'=>$request['numero_doc'],
            'direccion'=>$request['direccion'],
            'telefono'=>$request['telefono'],
            'email'=>$request['email'],
        ]);
        return Redirect::to('ventas/cliente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('ventas.cliente.show',['persona'=>Persona::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('ventas.cliente.edit',['persona'=>Persona::findOrFail($id)]);
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
        $persona->save();
        return Redirect::to('ventas/cliente');

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
        return Redirect::to('ventas/cliente');
    }
}
