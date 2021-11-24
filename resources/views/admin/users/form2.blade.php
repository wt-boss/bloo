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
$img_url = (isset($user) ? $user->avatar : url('/') . config('variables.avatar.public') . 'avatar1.png');
?>

<div class="form-group focused" >
    <label for="first_name">Noms</label>
    <input class="form-control" name="first_name" type="text" value="{{$user->first_name}}" id="first_name" required>
</div>

<div class="form-group focused">
    <label for="last_name">Prénoms</label>
    <input class="form-control" name="last_name" type="text" value="{{$user->last_name}}" id="last_name">
</div>

<div class="form-group focused" >
    <label for="email">Email</label>
    <input class="form-control" name="email" type="email" value="{{$user->email}}" id="email">
</div>

<div class="form-group focused">
    <label for="role">Role</label>
    @if($user->role === 4)
        <select class="form-control" id="role" name="role"  disabled>
            <option value="4" selected="selected">Client</option>
        </select>
        @elseif($user->role === 5)
        <select class="form-control" id="role" name="role"  disabled>
            <option value="5" selected="selected">Admin</option>
        </select>
    @else
    <select class="form-control" id="role" name="role"  required>
        <option value="" selected="selected"></option>
        <option value="0" @if($user->role === 0) selected @endif>Lecteur</option>
        <option value="1" @if($user->role === 1) selected @endif>Opérateur</option>
    </select>
    @endif
</div>

<div class="form-group focused" >
    <label for="active" >Active</label>
    <select class="form-control" id="active" name="active" required>
        <option value="0" @if($user->active === 0) selected @endif>Non</option>
        <option value="1" @if($user->active === 1) selected @endif>Oui</option>
    </select>
</div>


<div class="form-group focused" >
    <label for="avatar" >Avatar</label>
    <img src="{{$img_url}}" style="width:90px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"> <input class="inputfile" name="avatar" type="file" id="avatar" wfd-id="49">
</div>


