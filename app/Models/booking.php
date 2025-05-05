<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'status',
        'total_amount', 
        'total_occupancy',
        'start_date',
        'end_date',
    ];

    public function room()
    {
        return $this->hasOne('App\Models\Room', 'id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    use HasFactory;
}
