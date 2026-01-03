<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Determine if this user is the seeded root user.
     * Uses application config fallback to 'root@root.com'.
     */
    public function isRoot(): bool
    {
        $rootEmail = config('app.root_email', 'root@root.com');
        return strtolower($this->email) === strtolower($rootEmail);
    }

    /**
     * Attribute accessor for `is_root` to use in Blade templates easily.
     */
    public function getIsRootAttribute(): bool
    {
        return $this->isRoot();
    }
}
