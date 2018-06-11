<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\IngresoRequest;
use Redirect;
use laravelVue\Ingreso;
use laravelVue\DetalleIngreso;
use laravelVue\Persona;
use laravelVue\Articulo;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;



class IngresoController extends Controller
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
            
            $ingresos=DB::table('ingresos as i')
                ->JOIN('personas as p','i.id_proveedor','=','p.id')
                ->JOIN('detalles_ingresos as di','di.id_ingreso','=','i.id')
                ->SELECT('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
                ->WHERE('i.numero_comprobante','LIKE','%'.$query.'%')
                ->groupBy('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado')
                ->orderBy('i.id','ASC')
                ->paginate(7);
                return view('compras.ingreso.index',['ingresos'=>$ingresos,'searchText'=>$query]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas=DB::table('personas')->where('tipo','=','Proveedor')->get();
        $articulos=DB::table('articulos as art')
            ->SELECT(DB::raw('CONCAT(art.codigo, " ", art.nombre) AS articulo'),'art.id')
            ->WHERE('art.estado','=','Activo')->get();

        return view('compras.ingreso.create',['personas'=>$personas,'articulos'=>$articulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngresoRequest $request)
    {
        $mytime=Carbon::now('America/Argentina/Buenos_Aires');
        $fecha_hora=$mytime->toDateTimeString();

        try{
            DB::beginTransaction();
            //$mytime=Carbon::now('America/Argentina/Buenos_Aires');
            $ingreso = Ingreso::create([
            'id_proveedor'=>$request['id_proveedor'],
            'tipo_comprobante'=>$request['tipo_comprobante'],
            'serie_comprobante'=>$request['serie_comprobante'],
            'numero_comprobante'=>$request['numero_comprobante'],
            //'fecha_hora'=>$mytime->toDateTimeString(), 
            'fecha_hora'=>$fecha_hora, 
            'impuesto'=>18,
            'estado'=>'A',
            ]);
            $id_articulo=$request->get('id_articulo');
            $cantidad=$request->get('cantidad');
            $precio_compra=$request->get('precio_compra');
            $precio_venta=$request->get('precio_venta');
            
            $cont=0;
            while($cont < count($id_articulo)){
                $detalle = new DetalleIngreso();
                $detalle->id_ingreso=$ingreso->id;
                $detalle->id_articulo=$id_articulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->precio_compra=$precio_compra[$cont];
                $detalle->fecha_hora=$fecha_hora;
                $detalle->save();
                $cont=$cont+1;
                
            }
            DB::commit();
            
        }catch(\Exception $e){
            DB::rollback();
        }

        return Redirect::to('compras/ingreso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingreso=DB::table('ingresos as i')
                ->JOIN('personas as p','i.id_proveedor','=','p.id')
                ->JOIN('detalles_ingresos as di','di.id_ingreso','=','i.id')
                ->SELECT('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
                ->where('i.id','=',$id)
            ->groupBy('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado')
                ->first();
                         
        $detalles=DB::table('detalles_ingresos as di')
                ->JOIN('articulos as a','di.id_articulo','=','a.id')
                ->SELECT('a.nombre as articulo','di.cantidad as cantidad','di.precio_compra as compra','di.precio_venta as venta')
                ->WHERE('di.id_ingreso','=',$id)->get();         
        return view('compras.ingreso.show',['ingreso'=>$ingreso,'detalles'=>$detalles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
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
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso = Ingreso::find($id);
        $ingreso->estado='Cancelado';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}