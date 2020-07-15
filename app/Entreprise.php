<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $filliabble = [];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
