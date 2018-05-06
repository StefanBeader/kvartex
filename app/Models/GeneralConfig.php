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
        $bankAccount = static::find(1)->bank_account;
        $bank_account1 = substr($bankAccount, 0, -15);
        $bank_account2 = substr($bankAccount, 0, -2);
        $bank_account2 = substr($bank_account2, 3);
        $bank_account3 = substr($bankAccount, 0, -16);
        return [
            $bank_account1, $bank_account2, $bank_account3
        ];
    }

    public static function getReceiverInfo()
    {
        return static::find(1)->receiver_info;
    }
}
