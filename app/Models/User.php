<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UsesUuid;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, UsesUuid;

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
