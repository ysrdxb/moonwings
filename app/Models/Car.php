<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'model_id',
        'name',
        'slug',
        'year',
        'user_id',
        'license_plate',
        'seating_capacity',
        'transmission',
        'color',
        'doors',
        'baggage',
        'fuel_type',
        'daily_rate',
        'hourly_rate',
        'per_km_rate',
        'transfer_mode',
        'rental_mode',
        'image',
        'gallery',
        'video_link',
        'is_featured',
        'featured_from',
        'featured_to',
        'is_available',
        'status',
        'meta_title',
        'meta_description',
    ];

    public function category()
    {
        return $this->belongsTo(CarCategory::class, 'category_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getGalleryAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setGalleryAttribute($value)
    {
        $this->attributes['gallery'] = json_encode($value);
    }
}
