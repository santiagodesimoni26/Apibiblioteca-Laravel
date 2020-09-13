<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    public function User()
    {

return $this->hasMany(User::Class);
    }

    
}
