<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['room_id', 'user_id', 'review', 'rating'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($review) {
            $review->room->updateAverageRating();
        });
        static::deleting(function ($review) {
            if ($review->room) {
                $review->room->updateAverageRating();
            }
        });
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
