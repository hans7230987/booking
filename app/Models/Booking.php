<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'venue_id',
        'court_id',
        'start_time',
        'end_time',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if ($booking->court_id && !$booking->venue_id) {
                $court = Court::find($booking->court_id);
                if ($court) {
                    $booking->venue_id = $court->venue_id; 
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
