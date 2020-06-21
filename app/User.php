<?php

namespace App;

use App\Mail\EmailVerificationMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'active', 'api_token','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get user role name
     *
     * $return string
     */
    public function rolename()
    {
        return config('variables.role')[$this->attributes['role']];
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
/**
* Découvrez si l'utilisateur a un rôle spécifique
     *
     * $return boolean
     */
    public function hasRole($roles)
    {
        return in_array($this->rolename(), explode("|", $roles));
    }


    public function getAvatarAttribute($value)
    {
        if (!$value) {

            return url('/') . config('variables.avatar.public') . 'avatar0.png';
        }

        return url('/') . config('variables.avatar.public') . $value;
    }
    public function setAvatarAttribute($photo)
    {
        $this->attributes['avatar'] = (new Http\move)->move_file($photo, 'avatar.image');
    }



    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function collaboratedForms()
    {
        return $this->belongsToMany(Form::class, 'form_collaborators', 'user_id', 'form_id')
            ->withTimestamps();
    }

    public function isFormCollaborator($form)
    {
        return !is_null($this->collaboratedForms()->find($form));
    }
}
