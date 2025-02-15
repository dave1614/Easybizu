<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'balance',
        'date',
        'time',
    ];
}
