<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'waste_type',
        'weight',
        'price_per_kg',
        'total_price',
        'notes',
        'photo_path',
        'status',
        'sale_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
