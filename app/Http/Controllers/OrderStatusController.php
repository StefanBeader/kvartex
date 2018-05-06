<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function setStatus(Request $request)
    {
        OrderStatus::where('order_id', $request->order_id)->update(['status_code' => $request->status_code]);

        $request->session()->flash('orderStatus', 'Task was successful!');
        return redirect()->back();
    }
}
