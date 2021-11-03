<?php


namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExtraSubscription extends Pivot
{
    protected $guarded=[];
    public $incrementing = true;
}