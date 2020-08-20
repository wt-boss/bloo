<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{

    protected $fillable = [
        'front', 'rear','user_id'
    ];



    public function setFrontAttribute($photo)
    {
        $this->attributes['front'] = (new Http\move)->move_file($photo, 'avatar.image');
    }



    public function setRearAttribute($photo)
    {
        $this->attributes['rear'] = (new Http\move)->move_file($photo, 'avatar.image');
    }


    public function user()
    {
        $this->belongsTo(User::class);
    }

}
