<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'phone',
        'email',
        'website',
        'address',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'logo_url',
        'cover_image_url',
        'is_verified',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'is_verified' => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function menuTemplates()
    {
        return $this->hasMany(MenuTemplate::class);
    }

    public function schedules()
    {
        return $this->hasMany(RestaurantSchedule::class);
    }

    public function reviews()
    {
        return $this->hasMany(RestaurantReview::class);
    }

    public function todayMenu()
    {
        return $this->hasOne(Menu::class)
            ->where('date', now()->toDateString())
            ->where('status', 'published');
    }

    public function scopeNearby($query, float $lat, float $lng, int $radiusMeters = 5000)
    {
        return $query->whereRaw(
            'ST_DWithin(location, ST_MakePoint(?, ?)::geography, ?)',
            [$lng, $lat, $radiusMeters]
        );
    }
}
