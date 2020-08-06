<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $guarded = [];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
