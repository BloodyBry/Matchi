<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
    ];

    public function sportsCenters()
    {
        return $this->hasMany(SportsCenter::class, 'manager_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}