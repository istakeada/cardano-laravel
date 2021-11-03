<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

    protected $fillable = ['uuid', 'name', 'email', 'password'];

    protected $hidden = ['id', 'password', 'remember_token', 'email_verified_at', 'admin', 'updated_at', 'created_at', 'deleted_at'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFindUuid($query, $uuid)
    {
        return $query->whereUuid($uuid);
    }

    public function scopeFindEmail($query, $email)
    {
        return $query->whereEmail($email);
    }
}
