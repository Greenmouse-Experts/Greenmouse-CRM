<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'task', 'status', 'reminder_time'
    ];

    protected $dates = ['reminder_time'];
}
