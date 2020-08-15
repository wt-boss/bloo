<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'front face', 'rear face'
    ];

    public function setAvatarAttribute($photo)
    {
        $this->attributes['front face'] = (new Http\move)->move_file($photo, 'avatar.image');
        $this->attributes['rear face'] = (new Http\move)->move_file($photo, 'avatar.image');
    }


    public function user()
    {
        $this->belongsTo(User::class);
    }

}
