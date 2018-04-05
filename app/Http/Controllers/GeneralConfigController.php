<?php

namespace App\Http\Controllers;

use App\Models\GeneralConfig;
use Illuminate\Http\Request;

class GeneralConfigController extends Controller
{
    public function edit(GeneralConfig $config)
    {
        return view('generalConfig.edit', compact('config'));
    }
}
