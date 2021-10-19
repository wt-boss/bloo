<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = ['Montant','payementCycle','timeTest','userTest','reduction'];

    public function subscriptions()
    {
        return $this->belongsToMany('App\Subscription');
    }

}
