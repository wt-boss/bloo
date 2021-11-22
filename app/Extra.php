<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
  protected $guarded=[];

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class)->using(ExtraSubscription::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
