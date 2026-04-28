<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportsCenter extends Model
{
    protected $fillable = [
        'manager_id',
        'name',
        'city',
        'address',
        'description',
        'phone',
        'image',
        'opening_time',
        'closing_time',
        'status',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'center_id');
    }
}