<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guarded = [];

    public static function rules()
    {
        return [
          'display_name' => 'required|string',
          'short_name' => 'nullable|string',
          'wallet_bitstamp' => 'required|string',
          'wallet_cex' => 'required|string',
          'order' => 'required|integer',
          'is_active' => 'required|bool',
        ];
    }

    public static function getOptions()
    {
        $data = static::orderBy('order', 'ASC')->get();
        $currencies = [];

        foreach ($data as $currency) {
            if ($currency->is_active) {
                $currencies[$currency->id] = $currency->display_name;
            }
        }
        return $currencies;
    }

    public static function getName($id)
    {
        return static::find($id)->display_name;
    }
}
