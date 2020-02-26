<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numbers extends Model
{
    public function contacts()
    {
        return $this->belongsTo('App\Contact', 'contact_id');
//        return $this->belongsTo(Contact::class);
    }
}
