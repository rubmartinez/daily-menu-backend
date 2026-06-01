<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dish_id',
        'rating',
        'comment',
    ];

    protected $table = 'dish_reviews';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
