<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numbers extends Model
{
    public function contact()
    {
        return $this->belongsTo('App\Contact');
//        return $this->belongsTo(Contact::class);
    }
}
