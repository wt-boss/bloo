<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ShareFormLinkMail;
use App\Mail\FormCollaborationMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Form extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_OPEN = 'open';
    const STATUS_CLOSED = 'closed';

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['fields', 'responses'];

    protected $fillable = [
        'user_id', 'title', 'description', 'code', 'status',
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function responses()
    {
        return $this->hasMany(FormResponse::class);
    }

    public function collaborationUsers()
    {
        return $this->belongsToMany(User::class, 'form_collaborators', 'form_id', 'user_id')
            ->withTimestamps();
    }

    public function availability()
    {
        return $this->hasOne(FormAvailability::class);
    }

    public function generateCode()
    {
        do {
            $this->code = Str::random(32);
        } while (static::where('code', $this->code)->exists());
    }

    public function shareFormViaMail($email, $data)
    {
        $message = new ShareFormLinkMail($this, $data);
        Mail::to($email)->send($message);
    }

    public function addCollaboratorAndSendEmail(User $user, $email_message = '', $is_user_new = false)
    {
        $this->collaborationUsers()->save($user);

        $message = new FormCollaborationMail($this, $user, $email_message, $is_user_new);
        Mail::to($user->email)->send($message);
    }

    public static function getStatusSymbols()
    {
        return [
            static::STATUS_DRAFT => ['label' => 'Draft', 'color' => 'slate'],
            static::STATUS_PENDING => ['label' => 'Ready to Open', 'color' => 'primary'],
            static::STATUS_OPEN => ['label' => 'Open', 'color' => 'success'],
            static::STATUS_CLOSED => ['label' => 'Closed', 'color' => 'pink'],
        ];
    }

     public function operation()
     {
        return $this->belongsTo(Opération::class);
     }
}
