<?php

namespace App\Models;

use App\Enums\Role as RoleEnum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        "is_admin",
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

    public function roles()
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

    public function hasRole(RoleEnum $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }

    public function role()
    {
        return $this->roles()->first()->name;
    }

    public function level()
    {
        return $this->roles()->first()->level;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(RoleEnum::SUPER_ADMIN) && $this->isValid();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleEnum::ADMIN) && $this->isValid();
    }

    public function isUser(): bool
    {
        return $this->hasRole(RoleEnum::USER) && $this->isValid();
    }

    public function isManager(): bool
    {
        return $this->hasRole(RoleEnum::MANAGER) && $this->isValid();
    }

    public function isAuthor(): bool
    {
        return $this->hasRole(RoleEnum::AUTHOR) && $this->isValid();
    }

    public function isValid(): bool
    {
        return $this->is_active === true && $this->deleted_at === null;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions->contains('name', $permission);
    }

    public function scopeHasAnyRoles($query, array $roles)
    {
        return $query->whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        });
    }

    public function scopeRole($query, string $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    public function scopeWithoutRole($query, string $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->whereNot('name', $role);
        });
    }

    public function scopeHasAnyPermissions($query, array $permissions)
    {
        return $query->whereHas('permissions', function ($query) use ($permissions) {
            $query->whereIn('name', $permissions);
        });
    }

    public function scopePermission($query, string $permission)
    {
        return $query->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        });
    }

    public function scopeWithoutPermission($query, string $permission)
    {
        return $query->whereHas('permissions', function ($query) use ($permission) {
            $query->whereNot('name', $permission);
        });
    }
}