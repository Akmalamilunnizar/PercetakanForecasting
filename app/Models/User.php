<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Laravel\Passport\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;


class User extends Authenticatable implements CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, CanResetPassword, AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name',
        'username',
        'email',
        'nomor_telepon',
        'alamat',
        'password',
        'email_verified_at',
        'img'
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
        'id' => 'integer',
        'user_id' => 'integer',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orderss()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function role()
    {
        return $this->hasMany(Role::class, 'user_id');
    }
    // public function users()
    // {
    //     return $this->belongsTo(Order::class,'user_id', 'id');
    // }
}
