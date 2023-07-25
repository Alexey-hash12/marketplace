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

    const ROLE_ADMIN = 'ROLE_ADMIN';

    const ROLE_LOGIST = 'ROLE_LOGIST';

    const ROLE_STORE_KEEPER = 'ROLE_STORE_KEEPER';

    const ROLE_PACKER = 'ROLE_PACKER';

    public static array $userRoles = [
        self::ROLE_ADMIN => 'Админ',
        self::ROLE_LOGIST => 'Логист',
        self::ROLE_STORE_KEEPER => 'Кладовщик',
        self::ROLE_PACKER => 'Упаковщик'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
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
    ];
}
