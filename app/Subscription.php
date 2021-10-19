<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function suscriber()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function offers()
    {
        return $this->hasOne(Offer::class);
    }
    public function extras(){
        return $this->hasMany(Extra::class);
    }

    public function paiements()
    {
       // return $this->hasOne(Paiement::class);
    }
}
