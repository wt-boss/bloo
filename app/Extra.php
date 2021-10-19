<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
  protected $fillabe=['user_id','type','cost'];

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class)->using(ExtraSubscription::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
