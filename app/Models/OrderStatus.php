<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $guarded = [];

    protected $dates = [
        'finished_at',
        'created_at',
        'updated_at',
    ];
}
