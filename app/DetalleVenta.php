<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table ='detalles_ventas';
    
    protected $primaryKey='id';
    
    protected $fillable =[
        'id_venta',
        'id_articulo',
        'cantidad',
        'precio_venta',
        'descuento',       
    ];
        
    public $timestamps=false;
}
