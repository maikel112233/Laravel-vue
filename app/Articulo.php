<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table ='articulos';
    
    protected $primaryKey='id';
    
    protected $fillable =[
        'idCategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado',
    ];
    
    public $timestamps=false;    

}
