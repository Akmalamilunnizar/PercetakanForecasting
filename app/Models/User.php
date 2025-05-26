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
        'email',
        'nomor_telepon',
        'alamat',
        'password',
        'nomor_telepon',
        'username',
        'user',
        'alamat',
        'img'
    ];

    protected $attributes = [
        'img' => 'default-avatar.png'
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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

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



    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    public function roles()
    {
        return $this->morphToMany(
            config('laratrust.models.role'),
            'user',
            config('laratrust.tables.role_user'),
            'user_id',
            'role_id'
        );
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id', 'username', 'id');
    // }
    // public function users()
    // {
    //     return $this->belongsTo(Order::class,'user_id', 'id');
    // }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
