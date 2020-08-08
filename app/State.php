<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function country()
    {
        $this->belongsTo(Country::class);
    }
    public function cities()
    {
        $this->hasMany(City::class);
    }
}
