<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'make_id'];

    public function make()
    {
        return $this->belongsTo(CarMake::class, 'make_id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id');
    }
}
