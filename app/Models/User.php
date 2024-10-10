<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function isSuperAdmin(): bool
    {
        return $this->role === "super_admin";
    }

    public function isAdmin(): bool
    {
        return $this->role === "admin";
    }

    public function isUser(): bool
    {
        return $this->role === "user";
    }

    public function isManager(): bool
    {
        return $this->role === "manager";
    }

    public function isEditor(): bool
    {
        return $this->role === "editor";
    }
}