<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'checkin_date', 'checkout_date', 'total_people', 'message','response','responded_at'
    ];
}
