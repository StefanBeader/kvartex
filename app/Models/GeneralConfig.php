<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralConfig extends Model
{
    protected $guarded = [];

    public static function getMinAmount()
    {
        return static::find(1)->min_order_amount;
    }

    public static function getMaxAmount()
    {
        return static::find(1)->max_order_amount;
    }

    public static function getBankAccountNumber()
    {
        return static::find(1)->bank_account;
    }
}
