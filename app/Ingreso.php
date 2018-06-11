<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table ='ingresos';
    
    protected $primaryKey='id';
    
    protected $fillable =[
        'id_proveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
        'fecha_hora',
        'estado',
        'impuesto'
    ];
        
    public $timestamps=false;   
}
