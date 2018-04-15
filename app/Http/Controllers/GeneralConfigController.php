<?php

namespace App\Http\Controllers;

use App\Models\GeneralConfig;
use Illuminate\Http\Request;

class GeneralConfigController extends Controller
{
    public function edit()
    {
        $config = GeneralConfig::findOrFail(1);
        return view('generalConfig.edit', compact('config'));
    }
}
