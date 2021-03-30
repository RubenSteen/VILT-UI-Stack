<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UsesUuid;
use Illuminate\Support\Facades\Redis;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, UsesUuid;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            Redis::incr('new-users-current-month');
        });


        static::deleted(function ($user) {
            if ($user->created_at >= now()->startOfMonth()) {
                Redis::decr('new-users-current-month');
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *e.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->admin;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['trashed'] ?? null, function ($query, $value) {
            if ($value === 'with') {
                $query->withTrashed();
            } elseif ($value === 'only') {
                $query->onlyTrashed();
            }
        })->when($filters['verified_email'] ?? null, function ($query, $value) {
            if ($value === 'yes') {
                $query->whereNotNull('email_verified_at');
            } elseif ($value === 'no') {
                $query->where('email_verified_at', null);
            }
        });
    }

    public function scopeSearch($query, $value)
    {
        $query->when($value ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('username', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        });
    }
}
