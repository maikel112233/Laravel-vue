<?php

namespace laravelVue;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';
    
    protected $fillable =[
        'nombre',
        'precio',
        'stock',
        'link',
        'imagen'
    ];
}
