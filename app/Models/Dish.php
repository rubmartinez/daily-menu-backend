<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_section_id',
        'name',
        'description',
    ];

    public function section()
    {
        return $this->belongsTo(MenuSection::class, 'menu_section_id');
    }

    public function reviews()
    {
        return $this->hasMany(DishReview::class);
    }
}
