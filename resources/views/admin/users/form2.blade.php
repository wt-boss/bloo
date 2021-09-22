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
    <select class="form-control" id="role" name="role" >
        <option value="0">Lecteur</option>
        <option value="1" selected="selected">Opérateur</option>
        <option value="4">Client</option>
        <option value="5">Superadmin</option></select>
</div>

<div class="form-group focused" >
    <label for="active" >Active</label><select class="form-control" id="active" name="active" ><option value="0" selected="selected">Non</option><option value="1">Oui</option></select>
</div>


<div class="form-group focused" >
    <label for="avatar" >Avatar</label>
    <img src="{{$img_url}}" style="width:90px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"> <input class="inputfile" name="avatar" type="file" id="avatar" wfd-id="49">
</div>


