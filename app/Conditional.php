<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conditional extends Model
{
    public function conditional_fields(){

        return $this->hasMany(Conditional_field::class);
    }
}
