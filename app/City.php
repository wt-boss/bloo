<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function operations()
    {
        return $this->belongsToMany(Operation::class);
    }

        public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
