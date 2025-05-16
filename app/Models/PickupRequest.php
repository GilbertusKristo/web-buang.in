<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'coordinates',
        'waste_type',
        'estimated_weight',
        'pickup_date',
        'pickup_time',
        'notes',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
