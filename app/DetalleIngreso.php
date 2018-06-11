<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table ='detalles_ingresos';
    
    protected $primaryKey='id';
    
    protected $fillable =[
        'id_ingreso',
        'id_articulo',
        'cantidad',
        'precio_venta',
        'precio_compra'
       
    ];
        
    public $timestamps=false;   
}
