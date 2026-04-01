<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'center_id',
        'sport_id',
        'name',
        'description',
        'price_per_hour',
        'capacity',
        'image',
        'status',
    ];

    public function center()
    {
        return $this->belongsTo(SportsCenter::class, 'center_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function schedules()
    {
        return $this->hasMany(FieldSchedule::class);
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