<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'venue_id',   // 關聯到 Venue
        'type',       // 例如：羽球、籃球、桌球
        'capacity'
    ];

    // 與球館關聯
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
