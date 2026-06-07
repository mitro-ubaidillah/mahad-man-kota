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

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_ATTENDANCE_ADMIN = 'attendance_admin';
    public const ROLE_ARTICLE_ADMIN = 'article_admin';

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
        'admin_role',
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
        if (! $this->email) {
            return false;
        }

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

    public function isSuperAdmin(): bool
    {
        return $this->isRoot() || $this->admin_role === self::ROLE_SUPER_ADMIN;
    }

    public function canManageAttendance(): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->admin_role === self::ROLE_ARTICLE_ADMIN) {
            return false;
        }

        return $this->is_admin || $this->admin_role === self::ROLE_ATTENDANCE_ADMIN;
    }

    public function canManageArticles(): bool
    {
        return $this->isSuperAdmin() || $this->admin_role === self::ROLE_ARTICLE_ADMIN;
    }

    public function dashboardRoute(): string
    {
        return $this->canManageArticles() && ! $this->canManageAttendance()
            ? route('mahad-admin.dashboard')
            : route('dashboard');
    }

    public function roleLabel(): string
    {
        if ($this->isSuperAdmin()) {
            return 'Super Admin';
        }

        return match ($this->admin_role) {
            self::ROLE_ARTICLE_ADMIN => 'Admin Artikel',
            self::ROLE_ATTENDANCE_ADMIN => 'Admin Absensi',
            default => $this->is_admin ? 'Admin Absensi' : 'User Biasa',
        };
    }
}
