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

    public function update(Request $request)
    {
        $config = GeneralConfig::findOrFail(1);

        $config->update($request->all());

        return redirect()->back();
    }
}
