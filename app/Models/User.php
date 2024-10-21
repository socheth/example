<?php

namespace App\Models;

use App\Enums\RoleName;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "slug",
        "phone",
        "email",
        "password",
        "role",
        "is_active",
        "photo",
        "address",
        "gender",
        "creator_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function hasRole(RoleName $role)
    {
        return $this->roles()->where('name', $role->value)->exists();
    }
    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    /******  642a6c9a-f8f9-417a-8617-10117890df7a  *******/
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin' && $this->isValid();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' && $this->isValid();
    }

    public function isUser(): bool
    {
        return $this->role === 'user' && $this->isValid();
    }

    public function isManager(): bool
    {
        return $this->role === 'manager' && $this->isValid();
    }

    public function isAuthor(): bool
    {
        return $this->role === 'author' && $this->isValid();
    }

    public function isValid(): bool
    {
        return $this->is_active === true && $this->deleted_at === null;
    }

    public function permissions(): array
    {
        return $this->roles()->with('permissions')->get()
            ->map(function ($role) {
                return $role->permissions->pluck('name');
            })->flatten()->values()->unique()->toArray();
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions(), true);
    }
}