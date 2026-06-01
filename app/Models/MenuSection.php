<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'name',
        'order',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
