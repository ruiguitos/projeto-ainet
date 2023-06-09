<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id' ,
        'name',
        'email',
        'password',
        'user_type',
        'blocked',
        'photo_url'
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
    ];

    public function customer(): HasOne{
        return $this->hasOne(Customer::class, 'id','id');
    }

    public function scopeClients($query)
    {
        return $query->where('user_type', 'C');
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->photo_url ? asset('storage/img/' . $this->photo_url) : asset('/img/default_img.png');
            },
        );
    }


}
