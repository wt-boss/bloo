<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];


        public static function rules($update = false, $id = null)
    {
        $commun = [
            'lat' =>  'required|unique:sites,lat,'.$id.'|unique:sites,lng,'.$id,
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
}
