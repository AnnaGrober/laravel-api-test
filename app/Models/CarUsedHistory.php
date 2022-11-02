<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class CarUsedHistory extends Model
{
    use HasFactory;

    protected $table = 'car_used_history';

    protected $fillable = [
        'user_id',
        'car_id',
        'started_at',
        'finished_at',
    ];
}
