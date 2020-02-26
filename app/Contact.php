<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function numbers()
    {
        return $this->hasMany('App\Numbers', 'contact_id');
//        return $this->hasMany(Numbers::class);
    }
}
