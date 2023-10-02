<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static find($id)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // User.php
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'product_name',
        'product_code',
        'type_account',
        //
        'level_account',
        'status',
        'provider_name',
        'provider_id',
        'region',
        'gender',
        'nickname',
        'date_of_birth',
        'image',
        'token',
        'state',
        'connection_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'provider_name', 'provider_id', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
