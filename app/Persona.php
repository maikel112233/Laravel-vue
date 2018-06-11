<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table ='personas';
    
    protected $primaryKey='id';
    
    protected $fillable =[
        'tipo',
        'nombre',
        'tipo_doc',
        'numero_doc',
        'direccion',
        'telefono',
        'email',
    ];
    
    public $timestamps=false;    
}
