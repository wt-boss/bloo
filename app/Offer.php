<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = ['payementCycle','timeTest','userTest','reduction'];

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

}
