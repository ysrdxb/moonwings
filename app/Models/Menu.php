<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'location', 'status'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'menu_id');
    }    
}
