<?php

namespace App;

use App\Events\UserNotification;
use Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'role', 'active', 'api_token','avatar','password','country_id','state_id','city_id', 'phone', 'phonepaiement','email_token'
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


    public static function rules($update = false, $id = null)
    {
        $commun = [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email'    => "required|email|unique:users,email,$id",
            'password' => 'nullable|confirmed',
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    /**
* Get user role name
*
* $return string
*/
    public function rolename()
    {
        return config('variables.role')[$this->attributes['role']];
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
    public function setPasswordAttribute($value='')
    {
        $this->attributes['password'] = bcrypt($value);
        // $this->attributes['password'] = Hash::make($value);
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

    /*
   |------------------------------------------------------------------------------------
   | Boot
   |------------------------------------------------------------------------------------
   */
    public static function boot()
    {
        parent::boot();
        static::updating(function($user)
        {
            $original = $user->getOriginal();
            if (Hash::check('', $user->password)) {
                $user->attributes['password'] = $original['password'];
            }
        });
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function sendEmailVerificationNotification()
    {
        $message = new EmailVerificationMail($this);
        Mail::to($this)->send($message);
    }

    public function hasVerifiedEmail()
    {
        return is_null($this->email_token);
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

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function operations()
    {
        return $this->belongsToMany(Operation::class);
    }

    public function entreprises()
    {
        return $this->belongsToMany(Entreprise::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role,
        ];
    }

    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

}
