<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_title',
        'image',
        'room_type',
        'wifi',
        'bed_type',
        'description',
        'price',
        'total_rooms',
        'average_rating',
        'room_view', 
        'total_occupancy', 
        'breakfast'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function updateAverageRating()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->save();
    }
}
