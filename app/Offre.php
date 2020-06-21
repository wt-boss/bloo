<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $guarded = [];
    public function paiements(){
        return $this->hasMany(Paiement::class);
    }

}
