<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\GeneralConfig;
use Illuminate\Http\Request;
use Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::orderBy('order')->get();
        return view('currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currencies/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), Currency::rules());
        if ($validation->fails()) {
            return redirect('currency/create')->withErrors($validation)->withInput();
        }
        Currency::create($request->all());
        return redirect('currency');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::find($id);
        return view('currencies/edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency = Currency::find($id);
        $validation = Validator::make($request->all(), Currency::rules());
        if ($validation->fails()) {
            return redirect('currency/' . $currency->id . '/edit')->withErrors($validation)->withInput();
        }
        $currency->update($request->all());
        return redirect('currency');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Currency::destroy($id);
        return redirect('currency');
    }

    public function getWalletForCurrency(Request $request)
    {
        $liteCoinId = Currency::where('short_name', 'ltc')->first()->id;

        if ($request->currency_id == $liteCoinId) {
            $primaryWallet = 'wallet_bitstamp';
        }else {
            $primaryWallet = 'wallet_' . GeneralConfig::find(1)->primary_wallet;
        }

        $currency = Currency::find($request->currency_id);

        if ($currency) {
            return [
                'status' => true,
                'data' => $currency->$primaryWallet
            ];
        }else {
            return [
                'status' => false
            ];
        }
    }
}
