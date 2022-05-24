<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerManagement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'address', 'address_2', 'phone_number',
        'email', 'occupation', 'property_of_interest', 'offer', 'when_do_you_want_to_move_in'
    ];
}
