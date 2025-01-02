<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'folder_name',
        'is_default',
        'footer_menu_id',
        'header_menu_id'
    ];

    public function footerMenu()
    {
        return $this->belongsTo(Menu::class, 'footer_menu_id');
    }

    public function headerMenu()
    {
        return $this->belongsTo(Menu::class, 'header_menu_id');
    }
}
