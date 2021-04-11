<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
            if ($user->created_at >= now()->startOfMonth()) {
                Redis::incr(config('redis.keys.users.new_current_month'));
            }
        });

        static::restored(function ($user) {
            if ($user->created_at >= now()->startOfMonth()) {
                Redis::incr(config('redis.keys.users.new_current_month'));
            }
        });

        static::deleted(function ($user) {
            if ($user->created_at >= now()->startOfMonth()) {
                Redis::decr(config('redis.keys.users.new_current_month'));
            }

            Redis::del(config('redis.keys.users.online').':'.$user->id);
            Redis::decr(config('redis.keys.users.online_count'));
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
        'last_active_at',
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

    public function getLastActiveAtAttribute($value)
    {
        if (is_null($value)) {
            $userRedisKey = config('redis.keys.users.online').':'.$this->id;

            if (! Redis::exists($userRedisKey)) {
                // Extra fail save if the query takes too long, and the user is just out of the cache. Then predict the time.
                return now()->subSeconds(config('user.online.expire'));
            }

            $value = json_decode(Redis::get($userRedisKey))->last_active_at;
        }

        return Carbon::create($value);
    }

    public function isOnline()
    {
        if ($this->last_active_at > now()->subSeconds(config('user.online.expire'))) {
            return true;
        }

        return false;
    }

    public function goesOnline()
    {
        $userRedisKey = config('redis.keys.users.online').':'.$this->id;

        if (! Redis::exists($userRedisKey)) {
            $this->timestamps = false;
            $this->last_active_at = null;
            $this->save();

            Redis::incr(config('redis.keys.users.online_count'));
        }

        Redis::set($userRedisKey, json_encode([
            'id' => $this->id,
            'username' => $this->username,
            'last_active_at' => now()->toDateTimeString(),
        ])
        );
    }

    public function goesOffline($dateTime, $skipRedisTasks = false)
    {
        $this->timestamps = false;
        $this->last_active_at = $dateTime;
        $this->save();

        if ($skipRedisTasks == false) {
            $userRedisKey = config('redis.keys.users.online').':'.$this->id;
            Redis::del($userRedisKey);
            Redis::decr(config('redis.keys.users.online_count'));
        }
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
