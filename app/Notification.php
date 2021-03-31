<?php

namespace App;

use App\Events\UserNotification;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   protected $guarded = [] ;

    protected $dispatchesEvents = [
        'created' => UserNotification::class,
    ];

}
