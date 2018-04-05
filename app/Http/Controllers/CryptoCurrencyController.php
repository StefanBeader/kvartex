<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrency;
use Illuminate\Http\Request;

class CryptoCurrencyController extends Controller
{

    public function getValues()
    {
        return CryptoCurrency::orderBy('created_at', 'DESC')->first();
    }
}
