<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    const ACTIVE = 1;
    const CANCELED = 2;
    const EXECUTED = 3;
    const DENIED = 4;

    protected $guarded = [];

    protected $dates = [
        'finished_at',
        'created_at',
        'updated_at',
    ];

    public function getCodeLabel()
    {
        switch ($this->status_code) {
            case(static::ACTIVE):
                return __('Aktivan');
                break;
            case(static::CANCELED):
                return __('Poništen');
                break;
            case(static::EXECUTED):
                return __('Realizovan');
                break;
            case(static::DENIED):
                return __('Odbijen');
                break;
            default:
        }
    }
}
