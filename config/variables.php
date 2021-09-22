<?php
return [

'boolean' => [
'0' => 'Non',
'1' => 'Oui',
],

'role' => [
'0' => 'Lecteur',
'1' => 'Opérateur',
'3' => 'Free',
'4' => 'Client',
'5' => 'Superadmin',
],

'status' => [
'1' => 'Active',
'0' => 'Inactive',
],

'avatar' => [
'public' => '/files/avatar/',
'folder' => public_path() . '/files/avatar/',

'image' => [
'width' => 160,
'height' => 160,
]
],

/*
|------------------------------------------------------------------------------------
| ENV of APP
|------------------------------------------------------------------------------------
*/
'APP_ADMIN' => env('APP_ADMIN', 'admin'),
'APP_TOKEN' => env('APP_TOKEN', 'admin123456'),
];
