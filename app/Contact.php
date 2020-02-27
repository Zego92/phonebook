<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function number()
    {
        return $this->hasMany('App\Numbers');
//        return $this->hasMany(Numbers::class);
    }
}
