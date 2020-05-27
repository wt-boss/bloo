<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use SoftDeletes;


    protected $guarded = [];
    protected $dates = ['deleted_at'];
   /*
    | Relationship between models
   */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
