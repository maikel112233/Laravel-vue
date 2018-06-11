<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\UsuarioRequest;
use Redirect;
use laravelVue\User;
use DB;


class UsuarioController extends Controller
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
            $usuarios=DB::table('users')
                ->where('name','like','%'.$query.'%')
                ->orderBy('name','desc')
                ->paginate(7);
            return view('seguridad.usuario.index',['usuarios'=>$usuarios,'searchText'=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seguridad.usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $usuarios = User::create($request->all());
        return Redirect::to('seguridad/usuario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('seguridad.usuario.edit',['usuario'=>User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->fill($request->all());
        $usuario->update();
        return Redirect::to('seguridad/usuario');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario=DB::table('users')->where('id','=',$id)->delete();
        return Redirect::to('seguridad/usuario');
    }
}
