<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markup extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'module_type',
        'module_id',
        'user_id',
        'status',
        'b2c_markup',
        'b2b_markup',
        'location',
        'user_markup'
    ];

    protected $casts = [
        'b2c_markup' => 'decimal:2',
        'b2b_markup' => 'decimal:2',
        'user_markup' => 'decimal:2',
    ];

    /**
     * Scope a query to only include active markups.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
