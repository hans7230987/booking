<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'venue_id',   
        'type',
        'capacity'
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
