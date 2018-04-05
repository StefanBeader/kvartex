<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Client;

class CryptoCurrencyValue
{
    public $curencies = [
      'bitcoin' => 'btcusd',
      'ripple' => 'xrpusd',
      'litecoin' => 'ltcusd',
      'ethereum' => 'ethusd',
    ];

    public $bitcoin;
    public $ripple;
    public $litecoin;
    public $ethereum;

    public function run()
    {
        $this->getValueFromBitstamp();
        $this->storeValues();
        $this->deleteValuesOlderThanDay();
    }

    protected function getValueFromBitstamp()
    {
        $client = new Client();

        foreach ($this->curencies as $name => $curency) {
            $res = $client->get("https://www.bitstamp.net/api/v2/ticker/{$curency}/");
            if ($res->getStatusCode() === 200) {
                $resBody = $res->getBody();
                $value = json_decode($resBody);
                $this->$name = $value->last;
            }
        }

    }

    protected function storeValues()
    {
        $currency = new CryptoCurrency();
        $currency->bitcoin = $this->bitcoin;
        $currency->ripple = $this->ripple;
        $currency->litecoin = $this->litecoin;
        $currency->ethereum = $this->ethereum;
        $currency->save();
    }

    protected function deleteValuesOlderThanDay()
    {
       CryptoCurrency::where('created_at', '<=', Carbon::yesterday())->delete();
    }
}