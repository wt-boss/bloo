<?php

namespace App;
use Cache;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $guarded = [];
    public function users(){
        return $this->belongsToMany(User::class);
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
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
      public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

}
