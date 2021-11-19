<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function forms()
    {
        return $this->belongsTo(Form::class)->using(ExtraSubscription::class);
    }
    public function topic()
    {
        return $this->belongsTo(User::class);
    }
}
