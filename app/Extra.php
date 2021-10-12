<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
  protected $fillabe=['user_id','type','cost','susbscription_id'];

    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
