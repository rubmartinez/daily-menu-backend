<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'menu_template_id',
        'date',
        'title',
        'description',
        'price',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function template()
    {
        return $this->belongsTo(MenuTemplate::class, 'menu_template_id');
    }

    public function sections()
    {
        return $this->hasMany(MenuSection::class)->orderBy('order');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeToday($query)
    {
        return $query->where('date', now()->toDateString());
    }
}
