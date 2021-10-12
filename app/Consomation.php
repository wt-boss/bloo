<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consomation extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function operations()
    {
        return $this->belongsTo(Operation::class);
    }
}
