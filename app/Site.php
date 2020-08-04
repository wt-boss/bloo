<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public function operations()
    {
        return $this->belongsTo(Operation::class);
    }
}
