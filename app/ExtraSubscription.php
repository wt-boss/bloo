<?php


namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExtraSubscription extends Pivot
{
    protected $guarded=[];
    public $incrementing = true;


    public function rolename()
    {
        return config('variables.role')[$this->attributes['role']];
    }
}
