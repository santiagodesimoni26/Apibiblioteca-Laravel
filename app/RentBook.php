<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentBook extends Model
{
    
    public function User() 
    {

       return $this->belongsTo(User::class, 'idusuario');




    }

    public function Book()

    {
        return $this->belongsTo(Book::class , 'idlibro');


    }
    

    
}
