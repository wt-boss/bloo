<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
     /*
     | Relationship between models
     */

     public function question()
     {
         return $this->belongsTo(Question::class);
     }
    public function responses()
    {
        return $this->hasMany(Survey_response::class);
    }
}
