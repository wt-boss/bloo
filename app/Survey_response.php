<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey_response extends Model
{
    protected $guarded = [];
    /*
    | Relationship between models
   */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
