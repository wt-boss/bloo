<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdminClient extends Pivot
{
    protected $guarded=[];
    public $incrementing = true;
}
