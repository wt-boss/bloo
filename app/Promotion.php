<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [];

    public function offer(){
        return $this->belongsTo('App\Offer');
    }
}
