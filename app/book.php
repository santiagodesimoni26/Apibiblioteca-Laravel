<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{


    protected $fillable = [
        'titulo', 'descripcion', 'autor', 'alquilado',
    ];
    //
    

    
    
}
