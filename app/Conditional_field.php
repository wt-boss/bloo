<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conditional_field extends Model
{
    public function conditionals(){
        return $this->belongsTo(Conditional::class);
    }
}
