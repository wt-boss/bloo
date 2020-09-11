<?php
$allowedRoles = config('variables.role');
if (Auth::user()->rolename() !== "Superadmin") {
    foreach ($allowedRoles as $key => $value ) {
        if ($key >= Auth::user()->role) {
            unset($allowedRoles[$key]);
        }
    }
}

//$img_url = (isset($item) ? $item->avatar : "http://placehold.it/160x160");
$img_url = (isset($user) ? $user->avatar : url('/') . config('variables.avatar.public') . 'avatar0.png');
?>
{!! Form::myInput('text', 'first_name', trans('first_name')) !!}

{!! Form::myInput('text', 'last_name', trans('last_name')) !!}

{!! Form::myInput('email', 'email', trans('Email')) !!}

{!! Form::mySelect('role', 'Role', $allowedRoles) !!}

{!! Form::mySelect('active', 'Active', config('variables.boolean')) !!}

{!! Form::myFileImage('avatar', 'Avatar', $img_url) !!}
