<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_number',
        'status',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function booking()
    {
        return $this->hasOne(booking::class, 'room_instance_id');
    }
}
