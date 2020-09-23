<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
