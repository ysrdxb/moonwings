<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_id',
        'user_id',
        'check_in',
        'check_out',
        'total_pax',
        'total_price',
        'status',
        'is_refundable',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'array',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(HotelRoom::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
