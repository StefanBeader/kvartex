<?php

namespace App\Http\Controllers;

use App\Grids\OrdersGrid;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = OrdersGrid::create();
        return view('orders.index', compact('grid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array_add($request->all(), 'user_id', Auth::user()->id);
        $order = Order::create($data);
        OrderStatus::create([
            'order_id' => $order->id
        ]);
        return [
            'message' => 'success',
            'order' => $order
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
           return view('orders.show', compact('order'));
    }
}
