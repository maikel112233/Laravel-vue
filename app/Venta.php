<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table ='ventas';
    
    protected $primaryKey='id';
    
    protected $fillable =[
        'id_cliente',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
        'fecha_hora',
        'estado',
        'total_venta',
        'impuesto',
    ];
        
    public $timestamps=false;
}
