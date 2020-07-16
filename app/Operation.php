<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
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
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

}
