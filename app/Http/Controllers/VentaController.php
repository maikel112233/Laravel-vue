<?php

namespace laravelVue\Http\Controllers;

use Illuminate\Http\Request;
use laravelVue\Http\Requests\VentaRequest;
use Redirect;
use laravelVue\Venta;
use laravelVue\DetalleVenta;
use laravelVue\Persona;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class VentaController extends Controller
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
            
            $ventas=DB::table('ventas as v')
                ->JOIN('personas as p','v.id_cliente','=','p.id')
                ->JOIN('detalles_ventas as dv','dv.id_venta','=','v.id')
                ->SELECT('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta')
                ->WHERE('v.numero_comprobante','LIKE','%'.$query.'%')
                ->groupBy('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta')
                ->orderBy('v.id','ASC')
                ->paginate(7);
                return view('ventas.venta.index',['ventas'=>$ventas,'searchText'=>$query]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas=DB::table('personas')->where('tipo','=','Cliente')->get();
        $articulos=DB::table('articulos as art')
            ->JOIN('detalles_ingresos as di','art.id','=','di.id_articulo')
            ->SELECT(DB::raw('CONCAT(art.codigo, " ", art.nombre) AS articulo'),'art.id','art.stock',DB::raw('avg(di.precio_venta) as precio_promedio'))
            ->WHERE('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('articulo','art.id','art.stock')
            ->get();
        return view('ventas.venta.create',['personas'=>$personas,'articulos'=>$articulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaRequest $request)
    {
        $mytime=Carbon::now('America/Argentina/Buenos_Aires');
        $fecha_hora=$mytime->toDateTimeString();

        try{
            DB::beginTransaction();
            $venta = Venta::create([
            'id_cliente'=>$request['id_cliente'],
            'tipo_comprobante'=>$request['tipo_comprobante'],
            'serie_comprobante'=>$request['serie_comprobante'],
            'numero_comprobante'=>$request['numero_comprobante'],
            'total_venta'=>$request['total_venta'],
            'fecha_hora'=>$fecha_hora, 
            'impuesto'=>18,
            'estado'=>'A',
            ]);
            
            $id_articulo=$request->get('id_articulo');
            $cantidad=$request->get('cantidad');
            $descuento=$request->get('descuento');
            $precio_venta=$request->get('precio_venta');
            
            $cont=0;
            while($cont < count($id_articulo)){
                $detalle = new DetalleVenta();
                $detalle->id_venta=$venta->id;
                $detalle->id_articulo=$id_articulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->descuento=$descuento[$cont];
                $detalle->save();
                $cont=$cont+1;

                
            }
            DB::commit();
            
        }catch(\Exception $e){
            DB::rollback();
        }

        return Redirect::to('ventas/venta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta=DB::table('ventas as v')
                ->JOIN('personas as p','v.id_cliente','=','p.id')
                ->JOIN('detalles_ventas as dv','dv.id_venta','=','v.id')
                ->SELECT('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta')
                ->where('v.id','=',$id)
                ->first();
                         
        $detalles=DB::table('detalles_ventas as dv')
                ->JOIN('articulos as a','dv.id_articulo','=','a.id')
                ->SELECT('a.nombre as articulo','dv.cantidad as cantidad','dv.descuento as descuento','dv.precio_venta as venta')
                ->WHERE('dv.id_venta','=',$id)->get();         
        return view('ventas.venta.show',['venta'=>$venta,'detalles'=>$detalles]);
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
        $venta = Venta::find($id);
        $venta->estado='Cancelado';
        $venta->update();
        return Redirect::to('ventas/venta');
    }
}
