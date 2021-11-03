<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = ['montant','payementCycle','timeTest','userTest','reduction'];

    public function subscriptions()
    {
        return $this->belongsToMany('App\Subscription');
    }

}
