<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    /*
    | Relationship between models
   */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function responses()
    {
        return $this->hasMany(Survey_response::class);
    }
}

