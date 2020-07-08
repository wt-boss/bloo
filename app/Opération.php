<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opération extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
