<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Define the table name if it is different from the default (pluralized 'services')
    protected $table = 'services';

    // Specify the fillable fields (attributes that can be mass-assigned)
    protected $fillable = [
        'title',
        'photo',
        'description',
    ];
}
