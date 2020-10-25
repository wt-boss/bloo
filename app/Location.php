<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }
}
