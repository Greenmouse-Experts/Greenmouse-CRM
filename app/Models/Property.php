<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'email',
        'phone_number', 'title', 'location',
        'description', 'per_sqm', 'price',
        'payment_plans', 'features', 'images'
    ];
}
