<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Root extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'source',
        'destination',
        'operational_days',
        'operational_timings',
        'frequency',	
        'gap',
        'passenger_capacity',	
        'min_fare',	
        'booking_fare',
        'status'
    ];
}
