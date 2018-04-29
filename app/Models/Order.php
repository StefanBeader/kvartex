<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const BUY = 1;
    const SELL = 2;
    protected $guarded = [];

    public static function rules()
    {
        return [
            'user_id' => 'required|int',
            'amount' => 'required|int',
            'bank_account' => 'required|string|max:20',
            'wallet' => 'required|string',
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->hasOne('App\Models\OrderStatus');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function getOrderTypeAttribute()
    {
        switch ($this->order_type_id) {
            case (static::BUY):
                return __('Kupovina');
                break;
            case (static::SELL):
                return __('Prodaja');
                break;
            default:
                return __('Greska');
        }
    }
}
